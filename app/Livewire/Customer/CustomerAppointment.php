<?php

namespace App\Livewire\Customer;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\CustomerInformation;
use App\Models\Feedback;
use App\Models\Shop;
use App\Models\Shop\Product;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
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

    public $stars = 0;


   
    public function table(Table $table): Table
    {
        return $table
            ->query(Appointment::query()->where('user_id', auth()->user()->id)->orderByDesc('created_at'))
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
                    'cancelled' => 'danger',
                }),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('rate')->label('Feedback & Rating')->visible(fn($record) => $record->status == 'accepted')->form([
                        Textarea::make('feedback')->required(),
                        ViewField::make('rating')->view('filament.forms.rating')
                    ])->modalWidth('xl')->action(
                        function($record, $data){
                           Feedback::create([
                            'appointment_id' => $record->id,
                            'feedback' => $data['feedback'],
                            'rate' => $this->stars,
                           ]);
                        }
                    ),
                    Action::make('cancel')->label('Cancel Appointment')->visible(fn($record) => $record->status == 'pending')->color('danger')->icon('heroicon-o-x-mark')->action(
                        function($record, $data){
                            $record->update([
                               'status' => 'cancelled',
                               'reason_for_cancellation' => $data['reason']
                            ]);
                            $query = CustomerInformation::where('user_id', $record->user_id)->first();
                            try {
                                $ch = curl_init();
                            $parameters = array(
                                'apikey' => '1aaad08e0678a1c60ce55ad2000be5bd', //Your API KEY
                                'number' => $query->contact,
                                'message' => "STYLESYNC SMS \n\n" .
                                "Dear " . $record->user->name . ",\n\n" .
                                "Your Appointment for " . Carbon::parse($record->date)->format('F d, Y h:i A') .
                                " has been cancelled due to the following reason provided by the customer. \n". "Reason: ". $data['reason'],
                                'sendername' => 'SEGU'
                            );
                            curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
                            curl_setopt( $ch, CURLOPT_POST, 1 );

                            //Send the parameters set above with the request
                            curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

                            // Receive response from server
                            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                            $output = curl_exec( $ch );

                            if (curl_errno($ch)) {
                                throw new \Exception(curl_error($ch)); // Catch any curl errors
                            }

                            curl_close ($ch);

                            \Log::info('Semaphore SMS Response: ' . $output);

                            } catch (\Exception $e) {
                                \Log::error('SMS Sending Failed: ' . $e->getMessage());
                            }

                            flash()->success('Cancel Appointment');



                        }
                    )->form([
                        Textarea::make('reason')->placeholder('Please enter your reason for cancellation')->required(),
                    ])->modalWidth('xl')->modalHeading('Cancel Appointment'),
                    // Action::make('reject')->color('danger')->icon('heroicon-o-hand-thumb-down'),
                    DeleteAction::make()->visible(fn($record) => $record->status == 'pending'),
                ])->hidden(
                    fn($record) => $record->status == 'rejected' || $record->status == 'cancelled' 
                ),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Appointment yet')->emptyStateDescription('Once you get Appointment, it will appear here.');
    }

    public function render()
    {
        return view('livewire.customer.customer-appointment');
    }
}
