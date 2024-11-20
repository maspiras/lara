<?php

namespace App\Repositories;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ReservationRepository extends BaseRepository
{
    #protected $model = Reservation::class;
    /* public function __construct()
    {
        $this->model = $model;
    } */
    protected $model;
    /* public function __construct(Reservation $model)
    {
        $this->model = $model;
    } */

    public function __construct()
    {
        $this->model = DB::table('reservations');
    }

    public function getMyReservation($id){
        return $this->model #distinct()->select(['reserved_services.reservation_id', 'reserved_services.host_id', 'reserved_services.user_id', 'reserved_services.service_id', 'services.service_name','reserved_services.amount', 'reserved_services.paymentstatus'])
            ->leftJoin('currencies', 'reservations.currency_id', '=', 'currencies.id')
            ->leftJoin('booking_sources', 'reservations.booking_source_id', '=', 'booking_sources.id')
            ->where('reservations.id', '=', $id)
            ->first();
    }

    
}
