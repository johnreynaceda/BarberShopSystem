<?php

namespace App\Livewire\Manager;

use App\Models\Barber;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Shop;
use App\Models\Shop\Product;
use App\Models\User;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Flasher\Noty\Prime\NotyInterface;

class ServiceList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public function table(Table $table): Table
    {
        return $table
            ->query(Service::query()->whereHas('serviceCategory', function($record){
                return $record->where('shop_id', auth()->user()->shop_id);
            }))->headerActions([

                Action::make('new_category')->color('danger')->icon('heroicon-o-squares-plus')->action(
                    function($data){
                        ServiceCategory::create([
                            'name' => $data['name'],
                            'shop_id' => auth()->user()->shop_id,
                        ]);
                        noty()->success('Category has been created');
                    }
                )->form([
                    TextInput::make('name')->label('Category Name'),
                ])->modalWidth('xl'),
                CreateAction::make('service')->color('main')->icon('heroicon-o-plus')->action(
                    function($data){
                        Service::create([
                            'name' => $data['service_name'],
                            'amount' => $data['amount'],
                            'service_category_id' => $data['category'],
                        ]);
                        noty()->success('Service has been created');
                    }
                )->form([
                    TextInput::make('service_name')->required(),
                    TextInput::make('amount')->numeric()->required(),
                    Select::make('category')->options(ServiceCategory::where('shop_id', auth()->user()->shop_id)->pluck('name', 'id'))
                ])->modalWidth('xl')->modalHeading('Add New Service'),
            ])
            ->columns([

                TextColumn::make('name')->label('SERVICE NAME')->searchable(),
                TextColumn::make('amount')->label('AMOUNT')->formatStateUsing(
                    fn($record) => '₱'. number_format($record->amount,2)
                )->searchable(),
                TextColumn::make('serviceCategory.name')->LABEL('CATEGORY')->searchable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('edit')->color('success')->form([
                    TextInput::make('name')->required(),
                    TextInput::make('amount')->numeric()->required(),
                    Select::make('service_category_id')->label('Category')->options(ServiceCategory::all()->pluck('name', 'id'))

                ])->modalWidth('xl')->modalHeading('Edit Barber'),
                DeleteAction::make('delete'),
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Services yet')->emptyStateDescription('Once you write your first services, it will appear here.');
    }

    public function render()
    {
        return view('livewire.manager.service-list');
    }
}
