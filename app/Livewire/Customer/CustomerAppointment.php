<?php

namespace App\Livewire\Customer;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\Shop;
use App\Models\Shop\Product;
use App\Models\User;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CustomerAppointment extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Appointment::query()->where('user_id', auth()->user()->id))
            ->columns([
                TextColumn::make('user.name')->label('CUSTOMER')->searchable(),
                TextColumn::make('service.name')->label('SERVICE')->searchable(),
                TextColumn::make('barber_id')->label('BARBER')->searchable()->formatStateUsing(
                    fn($record) => $record->barber->firstname.' '. $record->barber->lastname,
                ),
                TextColumn::make('date')->dateTime('F d, Y h:i A')->label('DATE & TIME')->searchable(),
                TextColumn::make('service.amount')->label('PRICE')->searchable()->formatStateUsing(
                    fn($record) => '₱'. number_format($record->service->amount, 2),
                ),
                TextColumn::make('mode_of_payment')->label('MODE OF PAYMENT')->searchable(),
                TextColumn::make('customer_type')->label('CUSTOMER TYPE')->searchable(),
                TextColumn::make('status')->label('STATUS')->searchable()->badge()->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'accepted' => 'success',
                    'rejected' => 'danger',
                }),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                ActionGroup::make([
                    // Action::make('accept')->color('success')->icon('heroicon-o-hand-thumb-up'),
                    // Action::make('reject')->color('danger')->icon('heroicon-o-hand-thumb-down'),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Barbers yet')->emptyStateDescription('Once you write your first barber, it will appear here.');
    }

    public function render()
    {
        return view('livewire.customer.customer-appointment');
    }
}
