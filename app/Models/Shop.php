<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function barbers(){
        return $this->hasMany(Barber::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
