<?php

namespace App\Livewire\Admin;

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


class ShopList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Shop::query())->headerActions([
                CreateAction::make('new')->color('main')->icon('heroicon-o-plus')->action(
                    function($data){
                        $shop = Shop::create([
                            'name' => $data['name'],
                            'contact' => $data['contact_number'],
                            'address' => $data['address']
                        ]);

                        User::create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'password' => bcrypt($data['password']),
                            'user_type' => 'shop manager',
                           'shop_id' => $shop->id,
                        ]);
                    }
                )->form([
                  Grid::make(2)->schema([
                    TextInput::make('name')->columnSpan(2)->required(),
                    TextInput::make('contact_number')->required()->numeric()->prefix('#'),
                    TextInput::make('address')->required(),
                  ]),
                  Fieldset::make('ACCOUNT INFORMATION')
                    ->schema([
                        TextInput::make('email')->required()->email(),
                        TextInput::make('password')->required()->password(),
                        TextInput::make('confirm_password')->required()->password()->same('password'),
                    ])
                ])->modalWidth('xl')->modalHeading('Add New Shop'),
            ])
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('contact')->label('CONTACT')->searchable(),
                TextColumn::make('address')->LABEL('ADDRESS')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success'),
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Shops yet')->emptyStateDescription('Once you write your first shop, it will appear here.');
    }

    public function render()
    {
        return view('livewire.admin.shop-list');
    }
}
