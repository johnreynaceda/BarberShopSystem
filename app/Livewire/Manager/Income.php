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


class Income extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Transaction::query())->columns([
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
                TextColumn::make('amount')
                    ->label('INCOME')
                    ->formatStateUsing(
                        fn($record) => '₱' . number_format((float) $record->amount - ($record->barber_commission + $record->admin_commission), 2)
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
                                'barber_commission' => ($record->amount * 0.20),
                                'admin_commission' =>  $record->customer_type  == 'Online' ? ($record->amount * (Commision::first()->percentage / 100)) : 0,
                            ]);

                        }
                    ),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Income yet!')->emptyStateDescription('Once customer get an appointment, your income will appear here.');
    }

    public function render()
    {
        return view('livewire.manager.income',[
            'incomes' => Transaction::whereHas('barber', function($record){
                $record->where('shop_id', auth()->user()->shop_id);
            })->selectRaw('SUM(amount - (barber_commission + admin_commission)) as total_income')
            ->value('total_income'),
        ]);
    }
}
