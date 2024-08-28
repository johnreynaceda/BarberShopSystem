<?php

namespace App\Livewire\Admin;

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

class CommissionList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $percentage;

    public function table(Table $table): Table
    {
        return $table
            ->query(Transaction::query()->where('admin_commission', '>', 0 ))->headerActions([
                Action::make('change_commission')->color('main')->action(
                    function($data){
                        sleep(2);
                        $commission = Commision::first();
                        $commission->update([
                            'percentage' => $data['percentage'],
                        ]);
                    }
                )->form([
                    TextInput::make('percentage')->numeric()->required()->default($this->percentage),
                ])->modalWidth('xl')
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
                TextColumn::make('admin_commission')
                    ->label('COMMISSION')
                    ->formatStateUsing(
                        fn($record) => '₱' . number_format((float) $record->admin_commission, 2)
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
                                'commission' => ($record->amount * 0.20) ,
                            ]);

                        }
                    ),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Commissions yet!')->emptyStateDescription('Once customer get an appointment, your commission will appear here.');
    }

    public function render()
    {
        $this->percentage = Commision::first()->percentage;
        return view('livewire.admin.commission-list');
    }
}
