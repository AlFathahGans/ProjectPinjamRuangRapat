<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description', 'is_available', 'status_id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
