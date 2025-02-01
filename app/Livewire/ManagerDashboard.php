<?php

namespace App\Livewire;

use App\Models\Barber;
use Livewire\Attributes\On;
use Livewire\Component;

class ManagerDashboard extends Component
{
    public $income = [];
    public $filter;

    #[On('updateChart')]
    public function handleUpdateChart(){
        $this->barberincomeData();
    }
    
    public function updatedFilter(){
        $this->barberincomeData();
        $names =  array_column($this->income, 'barber_name');
        $total =  array_column($this->income, 'total_commission');
        $this->dispatch('updateChart', [$names, $total]);
    }

    public function barberincomeData(){
       
    
        switch ($this->filter) {
            case 'Daily':
                $query = Barber::where('shop_id', auth()->user()->shop_id)
                    ->leftJoin('transactions', 'barbers.id', '=', 'transactions.barber_id')
                    ->select(
                        \DB::raw('CONCAT(barbers.firstname, " ", barbers.lastname) as barber_name'),
                        \DB::raw('COALESCE(SUM(transactions.barber_commission), 0) as total_commission')
                    )
                    ->whereDate('transactions.created_at', now()->toDateString())
                    ->groupBy('barbers.id', 'barbers.firstname', 'barbers.lastname');
                break;
    
            case 'Weekly':
                $query = Barber::where('shop_id', auth()->user()->shop_id)
                    ->leftJoin('transactions', 'barbers.id', '=', 'transactions.barber_id')
                    ->select(
                        \DB::raw('CONCAT(barbers.firstname, " ", barbers.lastname) as barber_name'),
                        \DB::raw('COALESCE(SUM(transactions.barber_commission), 0) as total_commission')
                    )
                    ->whereBetween('transactions.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                    ->groupBy('barbers.id', 'barbers.firstname', 'barbers.lastname');
                break;
    
            case 'Monthly':
                $query = Barber::where('shop_id', auth()->user()->shop_id)
                    ->leftJoin('transactions', 'barbers.id', '=', 'transactions.barber_id')
                    ->select(
                        \DB::raw('CONCAT(barbers.firstname, " ", barbers.lastname) as barber_name'),
                        \DB::raw('COALESCE(SUM(transactions.barber_commission), 0) as total_commission')
                    )
                    ->whereMonth('transactions.created_at', now()->month)
                    ->whereYear('transactions.created_at', now()->year)
                    ->groupBy('barbers.id', 'barbers.firstname', 'barbers.lastname');
                break;
    
            default:
                $query = Barber::where('shop_id', auth()->user()->shop_id)
                    ->leftJoin('transactions', 'barbers.id', '=', 'transactions.barber_id')
                    ->select(
                        \DB::raw('CONCAT(barbers.firstname, " ", barbers.lastname) as barber_name'),
                        \DB::raw('COALESCE(SUM(transactions.barber_commission), 0) as total_commission')
                    )
                    ->groupBy('barbers.id', 'barbers.firstname', 'barbers.lastname');
                break;
        }
    
        // Fetch the income data based on the selected filter
        $incomeData = $query->get()->map(function ($income) {
            return [
                'barber_name' => $income->barber_name,
                'total_commission' => (float) $income->total_commission, // Ensure it's a float
            ];
        })->toArray();
    
        // Now get all barbers and map their income with the fetched income data
        $this->income = Barber::where('shop_id', auth()->user()->shop->id)
            ->get()
            ->map(function ($barber) use ($incomeData) {
                // Match the barber's name with the income data
                $income = collect($incomeData)->firstWhere('barber_name', $barber->firstname . ' ' . $barber->lastname);
                return [
                    'barber_name' => $barber->firstname . ' ' . $barber->lastname,
                    'total_commission' => $income ? $income['total_commission'] : 0, // Default to 0 if no income found
                ];
            })->toArray();
        
    }

    public function mount(){
        $this->barberincomeData();
    }
    public function render()
    {
        return view('livewire.manager-dashboard');
    }
}
