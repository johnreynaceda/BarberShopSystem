<?php

namespace App\Livewire\Manager;

use App\Models\Barber;
use App\Models\Shop;
use App\Models\Shop\Product;
use App\Models\Transaction;
use App\Models\User;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
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

class CommissionList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $commission = 0;

    public function mount(){
        $this->commission = auth()->user()->shop->barberCommission->percent ?? 0;
    }

     public function table(Table $table): Table
    {
        return $table
            ->query(Transaction::query()->where('status', 'done')->whereHas('barber', function($record){
                $record->where('shop_id', auth()->user()->shop_id);
            }))->headerActions([
                Action::make('commission')->label('Manage Commission')->action(
                    function($data){
                        $this->commission = $data['percent'];
                       if (auth()->user()->shop->barberCommission) {
                        auth()->user()->shop->barberCommission->update(['percent' => $data['percent']]);
                       }else{
                        auth()->user()->shop->barberCommission()->create(['percent' => $data['percent']]);
                       }
                    }
                )->form([
                    TextInput::make('percent')->numeric()->prefix('%'),
                ])->modalWidth('xl')
            ])->columns([
                TextColumn::make('customer_name')->label('CUSTOMER')->searchable(),
                TextColumn::make('service_name')->label('SERVICE')->searchable(),
                TextColumn::make('barber_name')->label('BARBER')->searchable(),
                TextColumn::make('date')->dateTime('F d, Y h:i A')->label('DATE & TIME')->searchable(),
                
                TextColumn::make('mode_of_payment')->label('MODE OF PAYMENT')->searchable(),
                TextColumn::make('customer_type')->label('CUSTOMER TYPE')->searchable(),
                TextColumn::make('barber_commission')->label('COMMISSION')->formatStateUsing(
                    fn($record) => '₱'.number_format($record->barber_commission,2)
                ),
               



            ])
            ->filters([
                // ...
            ])
            ->actions([
               
            ])
            ->bulkActions([
                // ...
            ]) ->emptyStateHeading('No Transactions yet!')->emptyStateDescription('Once customer get an transaction, it will appear here.');
    }
    public function render()
    {
        return view('livewire.manager.commission-list');
    }
}
