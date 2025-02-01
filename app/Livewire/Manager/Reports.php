<?php

namespace App\Livewire\Manager;

use App\Models\Barber;
use App\Models\Post;
use App\Models\Service;
use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Reports extends Component implements HasForms
{
    use InteractsWithForms;

    public $get_report;
    public $search, $type;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('get_report')->live()->label('Select Report')->options([
                    'Income' => 'Income',
                    'Barbers' => 'Barbers',
                    'Services' => 'Services',
                    'Appointments' => 'Appointments',
                ]),
                // ...
            ]);
    }

    public function generateIncome(){
        switch ($this->type) {
            case 'Daily':
                return Transaction::whereHas('barber', function($record){
                    $record->where('shop_id', auth()->user()->shop_id);
                })->when($this->search, function($search){
                    $search->where('barber_name', 'like', '%'. $this->search.'%');
                })->whereDate('created_at', now())->get();
            case 'Weekly':
                return Transaction::whereHas('barber', function($record){
                    $record->where('shop_id', auth()->user()->shop_id);
                })->when($this->search, function($search){
                    $search->where('barber_name', 'like', '%'. $this->search.'%');
                })->whereBetween('created_at', [Carbon::parse(now())->startOfWeek(), Carbon::parse(now())->endOfWeek()])->get();
            case 'Monthly':
                return Transaction::whereHas('barber', function($record){
                    $record->where('shop_id', auth()->user()->shop_id);
                })->when($this->search, function($search){
                    $search->where('barber_name', 'like', '%'. $this->search.'%');
                })->whereBetween('created_at', [Carbon::parse(now())->startOfMonth(), Carbon::parse(now())->endOfMonth()])->get();
                // break;

            default:
                return Transaction::whereHas('barber', function($record){
                    $record->where('shop_id', auth()->user()->shop_id);
                })->when($this->search, function($search){
                    $search->where('barber_name', 'like', '%'. $this->search.'%');
                })->get();
                // break;
        }
    }

    public function render()
    {
        return view('livewire.manager.reports',[
            'incomes' => $this->generateIncome(),
            'barbers' => Barber::where('shop_id', auth()->user()->shop_id)->when($this->search, function($record){
                $record->where('firstname', 'like', '%'. $this->search.'%')->orWhere('lastname', 'like', '%'. $this->search. '%');
            })->get(),
            'services' => Service::whereHas('serviceCategory', function($record){
                $record->where('shop_id', auth()->user()->shop_id);
            })->when($this->search, function($search){
                $search->where('name', 'like', '%'. $this->search.'%');
            })->get(),
        ]);
    }
}
