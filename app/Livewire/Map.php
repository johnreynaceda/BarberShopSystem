<?php

namespace App\Livewire;

use App\Models\Shop;
use Livewire\Component;

class Map extends Component
{
    public $query = '';
    public $markers = [];

    public function mount()
    {
        $this->markers = Shop::select('latitude', 'longitude', 'name')->get();
    }

    public function updatedQuery()
    {
        $this->markers = Shop::where('name', 'like', '%' . $this->query . '%')
            ->select('latitude', 'longitude', 'name')
            ->get();

        $this->emit('updateMarkers', $this->markers);
    }

    public function render()
    {
        return view('livewire.map', [
            'markers' => $this->markers,
        ]);
    }


    public function getAppointment(){
        if (auth()->check()) {
            # code...
        }else{
            return redirect()->route('login');
        }
    }
}
