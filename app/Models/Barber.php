<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
