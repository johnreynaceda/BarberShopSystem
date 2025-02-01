<?php

namespace App\Livewire\Customer;

use App\Models\Barber;
use App\Models\Service;
use App\Models\Appointment;

use App\Models\ServiceCategory;
use App\Models\Shop;
use Illuminate\Support\Carbon;
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

    public function submitAppointment(){
        sleep(1);
        Appointment::create([
            'shop_id' => $this->shop_id,
            'service_id' => $this->services_id,
            'barber_id' => $this->barber_id,
            'user_id' => auth()->user()->id,
            'date' => Carbon::parse($this->date_of_appointment),
            'mode_of_payment' => $this->mode_of_payment,
            'customer_type' => 'Online',
        ]);

        $barber = Barber::find($this->barber_id); // Simplified query to find barber

        try {
            $ch = curl_init();
            $parameters = [
                'apikey' => '1aaad08e0678a1c60ce55ad2000be5bd', // Your API KEY
                'number' => $barber->contact,
                'message' => "STYLESYNC SMS \n\nDear ". $barber->lastname. ", \nYou have an appointment with the customer. On " . Carbon::parse($this->date_of_appointment)->format('F d, Y h:i A'),
                'sendername' => 'SEGU',
            ];

            curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $output = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new \Exception(curl_error($ch)); // Catch any curl errors
            }

            curl_close($ch);

            // Log the response from the server for debugging (optional)
            \Log::info('Semaphore SMS Response: ' . $output);

        } catch (\Exception $e) {
            \Log::error('SMS Sending Failed: ' . $e->getMessage());
        }

        return redirect()->route('customer.appointments');
    }
}
