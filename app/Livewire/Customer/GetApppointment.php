<?php

namespace App\Livewire\Customer;

use App\Models\Barber;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Shop;
use Livewire\Component;

class GetApppointment extends Component
{
    public $steps = 1;
    public $shop_id;
    public $barber_id;

    public $service_id;
    public $services_id;
    public $date_of_appointment;
    public $mode_of_payment;

    public $preview_modal = false;

    public function mount(){
        $this->shop_id = request('id');
    }
    public function render()
    {
        return view('livewire.customer.get-apppointment',[
            'shop' => Shop::where('id', $this->shop_id)->first(),
            'services' => ServiceCategory::where('shop_id', $this->shop_id)->get(),
            'servicess' => Service::where('service_category_id', $this->service_id)->get(),
            'barbers' => Barber::where('shop_id', $this->shop_id)->get(),
        ]);
    }

    public function next(){
        sleep(1);
        $this->steps++;
    }

    public function previewRecord(){
        sleep(2);
        $this->preview_modal = true;
    }
}
