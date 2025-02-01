<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $services = [];
    public $incomeFilter = ''; // Stores the selected filter (daily, weekly, monthly)
    public $incomes = [];
    public $barbershops = [];

  

    
 

    

   
    public function mount()
    {
        $this->services = Service::leftJoin('appointments', 'services.id', '=', 'appointments.service_id')
            ->select('services.name as service_name', \DB::raw('count(appointments.id) as count'))
            ->groupBy('services.id', 'services.name')
            ->get()
            ->map(function($record) {
                return [
                    'service_name' => $record->service_name,
                    'count' => $record->count,
                ];
            })
            ->toArray();


        $this->barbershops = Shop::leftJoin('appointments', 'shops.id', '=', 'appointments.shop_id')
        ->select('shops.name as barber_name', \DB::raw('count(appointments.id) as count'))
        ->groupBy('shops.id', 'shops.name')
        ->get()
        ->map(function($record) {
            return [
                'barber_name' => $record->barber_name,
                'count' => $record->count,
            ];
        })
        ->toArray();

        $this->updateIncomeData();

       
    
        
    }

    #[On('updateChart')]
    public function handleUpdateChart(){
        $this->updateIncomeData();
    }

    public function updatedIncomeFilter()
    {
        $this->updateIncomeData(); 
        $names =  array_column($this->incomes, 'name');
        $total =  array_column($this->incomes, 'total_income');
        $this->dispatch('updateChart', [$names, $total]);
        

    }

    private function updateIncomeData()
    {
        switch ($this->incomeFilter) {
            case 'daily':
                $query = Shop::query()
                    ->select(
                        'shops.name',
                        \DB::raw('COALESCE(SUM(transactions.amount), 0) as total_income')
                    )
                    ->leftJoin('barbers', 'shops.id', '=', 'barbers.shop_id') 
                    ->leftJoin('transactions', function ($join) {
                        $join->on('barbers.id', '=', 'transactions.barber_id');
                    }) 
                    ->whereDate('transactions.created_at', now()->toDateString()) 
                    ->groupBy('shops.id', 'shops.name');
                break;

            
        
            case 'weekly':
                $query = Shop::query()
                    ->select(
                        'shops.name',
                        \DB::raw('COALESCE(SUM(transactions.amount), 0) as total_income')
                    )
                    ->leftJoin('barbers', 'shops.id', '=', 'barbers.shop_id') 
                    ->leftJoin('transactions', function ($join) {
                        $join->on('barbers.id', '=', 'transactions.barber_id');
                    }) 
                    ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()]) 
                    ->groupBy('shops.id', 'shops.name');
                break;
        
            case 'monthly':
                $query = Shop::query()
                    ->select(
                        'shops.name',
                        \DB::raw('COALESCE(SUM(transactions.amount), 0) as total_income')
                    )
                    ->leftJoin('barbers', 'shops.id', '=', 'barbers.shop_id') 
                    ->leftJoin('transactions', function ($join) {
                        $join->on('barbers.id', '=', 'transactions.barber_id');
                    }) 
                    ->whereMonth('transactions.created_at', now()->month) // Filter by this month
                    ->whereYear('transactions.created_at', now()->year) // Filter by this year
                    ->groupBy('shops.id', 'shops.name');
                break;
        
            default:
                $query = Shop::query()
                    ->select(
                        'shops.name',
                        \DB::raw('COALESCE(SUM(transactions.amount), 0) as total_income')
                    )
                    ->leftJoin('barbers', 'shops.id', '=', 'barbers.shop_id') 
                    ->leftJoin('transactions', function ($join) {
                        $join->on('barbers.id', '=', 'transactions.barber_id');
                    }) // Ensure shops with no transactions are included
                    ->groupBy('shops.id', 'shops.name');
                break;
        }
        
        $this->incomes = $query->get()->map(function ($income) {
            return [
                'name' => $income->name,
                'total_income' => (float) $income->total_income, 
            ];
        })->toArray();
        
        $this->incomes = Shop::all()->map(function ($shop) {
           
            $incomeData = collect($this->incomes)->firstWhere('name', $shop->name);
            return [
                'name' => $shop->name,
                'total_income' => $incomeData['total_income'] ?? 0, 
            ];
        })->toArray();
        
        
       
    }

    
   

    public function render()
    {
      
        return view('livewire.admin-dashboard');
    }
}
