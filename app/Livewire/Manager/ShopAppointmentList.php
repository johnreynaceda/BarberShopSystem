<?php
namespace App\Livewire\Manager;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShopAppointmentList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Appointment::query()->where('shop_id', auth()->user()->shop_id))
            ->columns([
                TextColumn::make('user.name')->label('CUSTOMER')->searchable(),
                TextColumn::make('service.name')->label('SERVICE')->searchable(),
                TextColumn::make('barber_id')->label('BARBER')->searchable()->formatStateUsing(
                    fn($record) => $record->barber->firstname . ' ' . $record->barber->lastname,
                ),
                TextColumn::make('date')->dateTime('F d, Y h:i A')->label('DATE & TIME')->searchable(),
                TextColumn::make('service.amount')->label('PRICE')->searchable()->formatStateUsing(
                    fn($record) => '₱' . number_format($record->service->amount, 2),
                ),
                TextColumn::make('mode_of_payment')->label('MODE OF PAYMENT')->searchable(),
                TextColumn::make('customer_type')->label('CUSTOMER TYPE')->searchable(),
                ViewColumn::make('status')->label('STATUS')->view('filament.tables.columns.status'),
                // TextColumn::make('status')
                //     ->label(fn($record) => optional($record->transaction)->status === 'done' ? 'Done & Paid' : 'STATUS')
                //     ->searchable()
                //     ->badge()
                //     ->color(fn($record): string => match ($record->status) {
                //         'pending'                   => 'warning',
                //         'accepted'                  => 'success',
                //         'rejected'                  => 'danger',
                //         'cancelled'                 => 'danger',
                //         default                     => optional($record->transaction)->status === 'done' ? 'primary' : 'secondary',
                //     }),

            ])
            ->filters([
                // ...
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('accept')->color('success')->icon('heroicon-o-hand-thumb-up')->action(
                        function ($record) {
                            $record->update([
                                'status' => 'accepted',
                            ]);

                            Transaction::create([
                                'appointment_id'  => $record->id,
                                'customer_name'   => $record->user->name,
                                'service_name'    => $record->service->name,
                                'barber_name'     => $record->barber->user->name,
                                'barber_id'       => $record->barber_id,
                                'date'            => Carbon::parse($record->date),
                                'amount'          => $record->service->amount,
                                'customer_type'   => $record->customer_type,
                                'mode_of_payment' => $record->mode_of_payment,
                            ]);
                        }
                    )->hidden(fn($record) => $record->status != ' pending'),
                    Action::make('reject')->color('danger')->icon('heroicon-o-hand-thumb-down')->action(
                        function ($record) {
                            $record->update([
                                'status' => 'rejected',
                            ]);
                        }
                    )->hidden(fn($record) => $record->status != ' pending'),
                    // DeleteAction::make(),
                ])->hidden(
                    fn($record) => $record->status == 'rejected' || $record->status == 'cancelled'
                ),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Appointments yet')->emptyStateDescription('Once customer get an appointment, it will appear here.');
    }

    public function render()
    {
        return view('livewire.manager.shop-appointment-list');
    }
}
