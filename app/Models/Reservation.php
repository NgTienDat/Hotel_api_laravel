<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['hotel_id', 'customer_name', 'customer_email', 'check_in', 'check_out'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function room()
    {
        return $this->belongsToMany(Room::class)->withTimestamps();
    }
}
