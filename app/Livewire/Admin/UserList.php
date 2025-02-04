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

class UserList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->where('user_type', '!=', 'admin'))->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('email')->LABEL('EMAIL')->searchable(),
                TextColumn::make('user_type')->LABEL('USER TYPE')->formatStateUsing(
                   function($record) {
                    switch ($record->user_type) {
                        case 'shop manager':
                            return strtoupper($record->user_type. ' - '. $record->shop->name);
                        case 'barber':
                            return strtoupper($record->user_type. ' - '. $record->barber->shop->name);

                        default:
                            return '';
                    }
                   }
                )->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Shops yet')->emptyStateDescription('Once you write your first shop, it will appear here.');
    }
    public function render()
    {
        return view('livewire.admin.user-list');
    }
}
