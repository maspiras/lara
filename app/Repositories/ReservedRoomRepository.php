<?php

namespace App\Repositories;
use App\Models\ReservedRooms;

class ReservedRoomRepository extends BaseRepository
{
    /*public $model = ReservedRooms::class;
    public function __construct()
    {
        $this->model = $model;
    } */
    protected $model;
    public function __construct(ReservedRooms $model)
    {
        $this->model = $model;
    }

    public function where($from, $to){
        
        /* $reservedrooms = $this->model->distinct()
        ->selectRaw('DAY(reserved_dates) AS reserved_dates , room_id, reservation_id, fullname, checkin, checkout')
        //->select('room_id', 'reservation_id')
        ->join('reservations', 'reserved_rooms.reservation_id', '=', 'reservations.id')
        ->whereYear('reserved_dates', $year)
        ->whereMonth('reserved_dates', $month)   
        ->orderBy('reserved_dates', 'asc')
        ->get(); */

        /* SELECT  
 DISTINCT 
 room_id, rr.room_id, r.fullname,
r.checkin, 	
 DATE(r.checkout) AS checkout 
FROM reserved_rooms rr
JOIN reservations r
ON rr.reservation_id=r.id */
        /* $reservedrooms = $this->model->distinct()
        ->selectRaw('room_id, fullname, checkin, DATE(checkout) AS checkout')
        ->join('reservations', 'reserved_rooms.reservation_id', '=', 'reservations.id')
        ->whereYear('reserved_dates', $year)
        ->whereMonth('reserved_dates', $month)   
        ->orderBy('reserved_dates', 'asc')
        ->get(); */
        $reservedrooms = $this->model->distinct()
        ->selectRaw('room_id, fullname, checkin, checkout, prepayment, DATE(checkout) AS checkoutday')
        ->join('reservations', 'reserved_rooms.reservation_id', '=', 'reservations.id')
        ->whereBetween('reserved_dates',
        [
            $from,
            $to
        ])
        ->orderBy('reserved_dates', 'asc')
        ->get();
        
     /*    ->whereBetween('creation_date',
        [
            Carbon::now()->startOfMonth()->format('Y-m-d'),
            Carbon::now()->endOfMonth()->format('Y-m-d')
        ]
    ) */

        return $reservedrooms;
    }
}
