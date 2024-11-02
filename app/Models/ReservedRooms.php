<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservedRooms extends Model
{
    public $timestamps = false;
    #protected $guarded = ['id'];   
    protected $fillable = [
        'reservation_id', 'room_id', 'reserved_dates'
    ];
}
