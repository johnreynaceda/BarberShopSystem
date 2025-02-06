<?php
namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\CustomerInformation;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BarberAppointment extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Appointment::query()->where('barber_id', auth()->user()->barber->id)->where('status', '!=', 'accepted')->orderBy('created_at', 'DESC'))
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
                TextColumn::make('status')->label('STATUS')->searchable()->badge()->color(fn(string $state): string => match ($state) {
                    'pending'                                                                                           => 'warning',
                    'accepted'                                                                                          => 'success',
                    'rejected'                                                                                          => 'danger',
                    'cancelled'                                                                                         => 'danger',
                }),
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
                                'customer_name'   => $record->user->name,
                                'service_name'    => $record->service->name,
                                'barber_name'     => $record->barber->user->name,
                                'barber_id'       => $record->barber_id,
                                'date'            => $record->date,
                                'amount'          => $record->service->amount,
                                'customer_type'   => $record->customer_type,
                                'mode_of_payment' => $record->mode_of_payment,
                            ]);

                            $query = CustomerInformation::where('user_id', $record->user_id)->first();

                            try {
                                $ch         = curl_init();
                                $parameters = [
                                    'apikey'     => '1aaad08e0678a1c60ce55ad2000be5bd', //Your API KEY
                                    'number'     => $query->contact,
                                    'message'    => "STYLESYNC SMS \n\n" . "Dear " . $record->user->name . "," . "\n\n" . "Your Request has been confirmed for " . Carbon::parse($record->date)->format('F d, Y h:i A') . ". " . "Please make sure to arrive on time for appointment, as being late may result in cancellation.",
                                    'sendername' => 'SEGU',
                                ];
                                curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
                                curl_setopt($ch, CURLOPT_POST, 1);

                                //Send the parameters set above with the request
                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

                                // Receive response from server
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $output = curl_exec($ch);

                                if (curl_errno($ch)) {
                                    throw new \Exception(curl_error($ch)); // Catch any curl errors
                                }

                                curl_close($ch);

                                \Log::info('Semaphore SMS Response: ' . $output);

                            } catch (\Exception $e) {
                                \Log::error('SMS Sending Failed: ' . $e->getMessage());
                            }

                            flash()->success('Done Transaction');

                        }
                    ),
                    Action::make('reject')->color('danger')->icon('heroicon-o-hand-thumb-down')->action(
                        function ($record) {
                            $record->update([
                                'status' => 'rejected',
                            ]);
                            $query = CustomerInformation::where('user_id', $record->user_id)->first();

                            try {
                                $ch         = curl_init();
                                $parameters = [
                                    'apikey'     => '1aaad08e0678a1c60ce55ad2000be5bd', //Your API KEY
                                    'number'     => $query->contact,
                                    'message'    => "STYLESYNC SMS \n\n" .
                                    "Dear " . $record->user->name . ",\n\n" .
                                    "Your request has been rejected for " . Carbon::parse($record->date)->format('F d, Y h:i A') . ". " .
                                    "Please note that your appointment has not been accepted.",
                                    'sendername' => 'SEGU',
                                ];
                                curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
                                curl_setopt($ch, CURLOPT_POST, 1);

                                //Send the parameters set above with the request
                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

                                // Receive response from server
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                $output = curl_exec($ch);

                                if (curl_errno($ch)) {
                                    throw new \Exception(curl_error($ch)); // Catch any curl errors
                                }

                                curl_close($ch);

                                \Log::info('Semaphore SMS Response: ' . $output);

                            } catch (\Exception $e) {
                                \Log::error('SMS Sending Failed: ' . $e->getMessage());
                            }

                            flash()->success('Reject Transaction');

                        }
                    ),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                // ...
            ])->emptyStateHeading('No Appointments yet')->emptyStateDescription('Once customer get an appointment, it will appear here.');
    }

    public function render()
    {
        return view('livewire.barber-appointment');
    }
}
