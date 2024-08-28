<?php

namespace App\Livewire\Admin;

use App\Models\Barber;
use App\Models\Shop;
use App\Models\Shop\Product;
use App\Models\User;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AllBarberList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Barber::query())->headerActions([
                CreateAction::make('new')->color('main')->icon('heroicon-o-plus')->action(
                    function($data){


                       $user =  User::create([
                            'name' => $data['firstname']. ' '.$data['lastname'],
                            'email' => $data['email'],
                            'password' => bcrypt($data['password']),
                            'user_type' => 'barber',
                        ]);
                        Barber::create([
                            'firstname' => $data['firstname'],
                            'lastname' => $data['lastname'],
                            'contact' => $data['contact_number'],
                            'address' => $data['address'],
                            'user_id' => $user->id,
                            'shop_id' => auth()->user()->shop_id,
                        ]);
                    }
                )->form([
                  Grid::make(2)->schema([
                    TextInput::make('firstname')->required(),
                    TextInput::make('lastname')->required(),
                    TextInput::make('contact_number')->required()->numeric()->prefix('#'),
                    TextInput::make('address')->required(),
                  ]),
                  Fieldset::make('ACCOUNT INFORMATION')
                    ->schema([
                        TextInput::make('email')->required()->email(),
                        TextInput::make('password')->required()->password(),
                        TextInput::make('confirm_password')->required()->password()->same('password'),
                    ])
                ])->modalWidth('xl')->modalHeading('Add New Barber'),
            ])
            ->columns([
                TextColumn::make('id')->label('FULLNAME')->searchable()->formatStateUsing(
                    fn($record) => $record->firstname. ' ' . $record->lastname
                ),

                TextColumn::make('user.email')->label('EMAIL')->searchable(),
                TextColumn::make('contact')->label('CONTACT')->searchable(),
                TextColumn::make('address')->LABEL('ADDRESS')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // EditAction::make('edit')->color('success')->form([
                //     Grid::make(2)->schema([
                //         TextInput::make('firstname')->required(),
                //         TextInput::make('lastname')->required(),
                //         TextInput::make('contact')->required()->numeric()->prefix('#'),
                //         TextInput::make('address')->required(),
                //       ]),

                // ])->modalWidth('xl')->modalHeading('Edit Barber'),
                // DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Barbers yet')->emptyStateDescription('Once you write your first barber, it will appear here.');
    }

    public function render()
    {
        return view('livewire.admin.all-barber-list');
    }
}
