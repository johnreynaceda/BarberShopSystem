<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\Shop;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Map extends Component implements HasForms
{
    use InteractsWithForms;
    public $query = '';
    public $service;
    public $markers = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('service')->options(Service::all()->pluck('name', 'id'))->searchable()->live()
            ]);
    }

  

    

    public function updatedQuery()
    {
        $this->markers = Shop::when($this->service, function($q){
            return $q->whereHas('serviceCategories', function($record){
                $record->whereHas('services', function($query){
                    $query->where('id', $this->service);
                });
            });
        })->select('latitude', 'longitude', 'name')->get();

        $this->emit('updateMarkers', $this->markers);
    }

    public function render()
    {
        $this->markers = Shop::when($this->service, function ($query) {
            return $query->whereHas('serviceCategories.services', function ($query) {
                $query->where('id', $this->service);
            });
        })
        ->with(['serviceCategories.services' => function ($query) {
            if ($this->service) {
                $query->where('id', $this->service)->select('id', 'name', 'amount', 'service_category_id');
            }
        }])
        ->select('id', 'latitude', 'longitude', 'name')
        ->get();
    

        return view('livewire.map');
    }


    public function getAppointment(){
        if (auth()->check()) {
            # code...
        }else{
            return redirect()->route('login');
        }
    }
}
