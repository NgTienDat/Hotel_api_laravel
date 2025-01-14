<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['hotel_id', 'room_type', 'capacity', 'available'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'room_reservation', 'room_id', 'reservation_id')->withTimestamps();
    }
}
