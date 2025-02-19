<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
   switch (auth()->user()->user_type) {
    case 'admin':
        return redirect()->route('admin.dashboard');
        break;
    case 'shop manager':
        return redirect()->route('manager.dashboard');
        break;
    case 'customer':
        return redirect()->route('customer.dashboard');
        break;
    case 'barber':
        return redirect()->route('barber.dashboard');
        break;

    default:
        # code...
        break;
   }
})->middleware(['auth', 'verified'])->name('dashboard');


//admin
Route::prefix('administrator')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', function(){
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/shops', function(){
        return view('admin.shops');
    })->name('admin.shops');
    Route::get('/users', function(){
        return view('admin.users');
    })->name('admin.users');
    Route::get('/barbers', function(){
        return view('admin.barbers');
    })->name('admin.barbers');
    Route::get('/commission', function(){
        return view('admin.commission');
    })->name('admin.commission');
});

//customer
Route::prefix('customer')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', function(){
        return view('customer.dashboard');
    })->name('customer.dashboard');
    Route::get('/barber-shops', function(){
        return view('customer.barber-shops');
    })->name('customer.barber-shops');
    Route::get('/barber-shops/{id}', function(){
        return view('customer.get-appointment');
    })->name('customer.get-appointment');
    Route::get('/appointments', function(){
        return view('customer.appointments');
    })->name('customer.appointments');
});

Route::prefix('barber')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/appointments', function(){
        return view('barber.dashboard');
    })->name('barber.dashboard');
    Route::get('/transactions', function(){
        return view('barber.transactions');
    })->name('barber.transactions');
});


//manager
Route::prefix('shop-manager')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', function(){
        return view('manager.dashboard');
    })->name('manager.dashboard');
    Route::get('/barbers', function(){
        return view('manager.barbers');
    })->name('manager.barbers');
    Route::get('/services', function(){
        return view('manager.services');
    })->name('manager.services');
    Route::get('/appointments', function(){
        return view('manager.appointments');
    })->name('manager.appointments');
    Route::get('/transactions', function(){
        return view('manager.transactions');
    })->name('manager.transactions');
    Route::get('/incomes', function(){
        return view('manager.incomes');
    })->name('manager.incomes');
    Route::get('/reports', function(){
        return view('manager.reports');
    })->name('manager.reports');
    Route::get('/commissions', function(){
        return view('manager.commissions');
    })->name('manager.commissions');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
