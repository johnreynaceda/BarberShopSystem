<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\Commision;
use App\Models\Service;
use App\Models\Shop;
use App\Models\Shop\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Livewire\Component;
use Filament\Tables\Columns\Summarizers\Sum;

class BarberTransaction extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $add_modal = false;

    public $amount, $cash, $change, $service;

    public $barber_name, $customer_name, $date, $mode_of_payment;

    public function mount(){
        $this->barber_name = auth()->user()->name;
    }

    public function updatedCash(){
        $this->change = (float)$this->cash - (float)$this->amount;
    }

    public function updatedService(){
        $data = Service::where('id', $this->service)->first()->amount;
        $this->amount = $data;

    }


    public function table(Table $table): Table
    {
        return $table
            ->query(Transaction::query()->where('barber_id', auth()->user()->barber->id))->headerActions([
               Action::make('add_transaction')->icon('heroicon-o-plus')->color('main')->action(
                function($record){
                    $this->add_modal = true;
                }
               )
            ])
            ->columns([
                TextColumn::make('customer_name')->label('CUSTOMER')->searchable(),
                TextColumn::make('service_name')->label('SERVICE')->searchable(),
                TextColumn::make('barber_name')->label('BARBER')->searchable(),
                TextColumn::make('date')->date('F d, Y h:i A')->label('DATE & TIME')->searchable(),
                TextColumn::make('id')->label('PRICE')->searchable()->formatStateUsing(
                    fn($record) => '₱'. number_format($record->amount, 2),
                ),
                TextColumn::make('mode_of_payment')->label('MODE OF PAYMENT')->searchable(),
                TextColumn::make('customer_type')->label('CUSTOMER TYPE')->searchable(),
                TextColumn::make(''),
                TextColumn::make('barber_commission')
                    ->label('COMMISSION')
                    ->formatStateUsing(
                        fn($record) => '₱' . number_format((float) $record->barber_commission, 2)
                    )
                    ->summarize(
                        Sum::make()->label('Total Commission')
                    )



            ])
            ->filters([
                // ...
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('done')->label('Done Transaction')->color('success')->icon('heroicon-s-check-badge')->action(
                        function($record){
                            $record->update([
                                'status' => 'done',
                                'barber_commission' => ($record->amount * (auth()->user()->barber->shop->barberCommission->percent /100)),
                                'admin_commission' =>  $record->customer_type  == 'Online' ? ($record->amount * (Commision::first()->percentage / 100)) : 0,
                            ]);

                        }
                    )->visible(fn($record) => $record->status != 'done'),
                    DeleteAction::make()->visible(fn($record) => $record->status != 'done'),
                ]),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Appointments yet')->emptyStateDescription('Once customer get an appointment, it will appear here.');
    }

    public function form(Form $form): Form {
        return $form->schema([
            Fieldset::make('TRANSACTION DETAILS')->schema([
                TextInput::make('customer_name')->label('CUSTOMER NAME'),
                Select::make('service')->label('SERVICE')->options(Service::whereHas('serviceCategory', function($record){
                     $record->where('shop_id', auth()->user()->barber->shop_id );
                })->pluck('name', 'id'))->reactive(),

                 TextInput::make('barber_name')->label('BARBER NAME')->default(auth()->user()->name)->disabled(),
                 DateTimePicker::make('date')->label('DATE & TIME'),
                 TextInput::make('amount')->label('AMOUNT')->numeric()->disabled(),
                 Select::make('mode_of_payment')->options([
                    'Cash' => 'Cash',
                    'GCash' => 'GCash',
                 ])->label('MODE OF PAYMENT'),
                 ]),
        ]);
    }

    public function submitTransaction(){
        $barber_id = Barber::where('user_id', auth()->user()->id)->first()->id;
        Transaction::create([
        'customer_name' => $this->customer_name,
        'service_name' => Service::whereId($this->service)->first()->name,
        'barber_name' => Barber::where('id', $barber_id)->first()->firstname. ' '. Barber::where('id', $barber_id)->first()->lastname,
        'barber_id' => $barber_id,
        'date' => Carbon::parse($this->date),
        'amount' => $this->amount,
       'mode_of_payment' => $this->mode_of_payment,
       'customer_type' => 'Walk-In',
       'barber_commission' => 0,
       'admin_commission' => 0,
        ]);

        $this->add_modal = false;

        return redirect()->route('barber.transactions');
    }

    public function render()
    {
        return view('livewire.barber-transaction');
    }
}
