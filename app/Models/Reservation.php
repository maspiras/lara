<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'checkin', 'checkout', 'adults', 'childs', 'pets', 'fullname',
        'phone', 'email', 'additional_info', 'booking_source_id', 'doorcode',
        'rateperday', 'daystay', 'subtotal', 'grandtotal', 'currency_id',
        'payment_type_id', 'prepayment', 'payment_status_id', 'balancepayment',
        'user_id', 'host_id'
    ];

    
}
