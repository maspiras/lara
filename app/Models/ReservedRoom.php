<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class ReservedRoom extends Model
{
    public $timestamps = false;
    #protected $guarded = ['id'];   
    protected $fillable = [
        'reservation_id', 'room_id', 'reserved_dates'
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}
