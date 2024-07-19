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

    default:
        # code...
        break;
   }
})->middleware(['auth', 'verified'])->name('dashboard');


//admin
Route::prefix('administrator')->group(function(){
    Route::get('/dashboard', function(){
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/shops', function(){
        return view('admin.shops');
    })->name('admin.shops');
});

//customer
Route::prefix('customer')->group(function(){
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


//manager
Route::prefix('shop-manager')->group(function(){
    Route::get('/dashboard', function(){
        return view('manager.dashboard');
    })->name('manager.dashboard');
    Route::get('/barbers', function(){
        return view('manager.barbers');
    })->name('manager.barbers');
    Route::get('/services', function(){
        return view('manager.services');
    })->name('manager.services');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
