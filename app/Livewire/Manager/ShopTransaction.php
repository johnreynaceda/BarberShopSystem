<?php

namespace App\Livewire\Manager;

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

class ShopTransaction extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $add_modal = false;

    public $amount, $cash, $change, $service;
    public $date, $mode_of_payment, $barber_id, $customer_name;

    public function table(Table $table): Table
    {
        return $table
            ->query(Transaction::query()->where('status', 'pending')->whereHas('barber', function($record){
                $record->where('shop_id', auth()->user()->shop_id);
            }))->headerActions([
               Action::make('add_transaction')->icon('heroicon-o-plus')->color('main')->action(
                function($record){
                    sleep(1);
                    $this->add_modal = true;
                }
               )
            ])
            ->columns([
                TextColumn::make('customer_name')->label('CUSTOMER')->searchable(),
                TextColumn::make('service_name')->label('SERVICE')->searchable(),
                TextColumn::make('barber_name')->label('BARBER')->searchable(),
                TextColumn::make('date')->dateTime('F d, Y h:i A')->label('DATE & TIME')->searchable(),
                // TextColumn::make('id')->label('PRICE')->searchable()->formatStateUsing(
                //     fn($record) => '₱'. number_format($record->amount, 2),
                // ),
                TextColumn::make('mode_of_payment')->label('MODE OF PAYMENT')->searchable(),
                TextColumn::make('customer_type')->label('CUSTOMER TYPE')->searchable(),
                TextColumn::make(''),
                // TextColumn::make('barber_commission')
                //     ->label('COMMISSION')
                //     ->formatStateUsing(
                //         fn($record) => '₱' . number_format((float) $record->commission, 2)
                //     )
                //     ->summarize(
                //         Sum::make()->label('Total Commission')
                //     )



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
                                'barber_commission' => ($record->amount * 0.20) ,
                                'admin_commission' => $record->customer_type == 'Online' ? ($record->amount * (Commision::first()->percentage / 100)) : ($record->amount * 0.20) ,
                            ]);

                        }
                    ),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Appointments yet')->emptyStateDescription('Once customer get an appointment, it will appear here.');
    }

    public function updatedCash(){
        $this->change = (float)$this->cash - (float)$this->amount;
    }

    public function updatedService(){
        $data = Service::where('id', $this->service)->first()->amount;
        $this->amount = $data;

    }


    public function form(Form $form): Form {
        return $form->schema([
            Fieldset::make('TRANSACTION DETAILS')->schema([
                TextInput::make('customer_name')->label('CUSTOMER NAME'),
                Select::make('service')->label('SERVICE')->options(Service::whereHas('serviceCategory', function($record){
                    $record->where('shop_id', auth()->user()->shop_id);
                })->get()->pluck('name', 'id'))->reactive(),
                Select::make('barber_id')->label('BARBER NAME')->options(Barber::where('shop_id', auth()->user()->shop_id)->get()->mapWithKeys(function($record){
                    return [$record->id => $record->firstname.' '.$record->lastname];
                })),
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

       Transaction::create([
        'customer_name' => $this->customer_name,
        'service_name' => Service::whereId($this->service)->first()->name,
        'barber_name' => Barber::where('id', $this->barber_id)->first()->firstname. ' '. Barber::where('id', $this->barber_id)->first()->lastname,
        'barber_id' => $this->barber_id,
        'date' => Carbon::parse($this->date),
        'amount' => $this->amount,
       'mode_of_payment' => $this->mode_of_payment,
       'customer_type' => 'Walk-In',
       'barber_commission' => (20 / 100) * $this->amount,
       'admin_commission' => 0,
       ]);

       $this->add_modal = false;

       $this->reset('amount', 'cash', 'change', 'service', 'date', 'mode_of_payment', 'barber_id', 'customer_name');
    }

    public function render()
    {
        return view('livewire.manager.shop-transaction');
    }

}
