<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
