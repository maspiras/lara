<?php

namespace App\Repositories;
use App\Models\ReservedRoom;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\DB;
class ReservedRoomRepository extends BaseRepository
{
    /*public $model = ReservedRooms::class;
    public function __construct()
    {
        $this->model = $model;
    } */
    protected $model;
    public function __construct()
    {
        $this->model = DB::table('reserved_rooms');
    }

    public function getMyReservedRooms($id){       
        return $this->model->distinct()->where('reservation_id', '=', $id)->get();
        
    }



     public function getHostReservedRooms($from, $to){
        
       
        $reservedrooms = $this->model->distinct()
        ->selectRaw('room_id, fullname, checkin, checkout, prepayment, DATE(checkout) AS checkoutday')
        ->join('reservations', 'reserved_rooms.reservation_id', '=', 'reservations.id')
        ->where('host_id', auth()->user()->host_id)
        ->whereBetween('reserved_dates',
        [
            $from,
            $to
        ])
        ->cursor()
        #->orderBy('reserved_dates', 'asc')
        ->sortByDesc('reserved_dates');

        return $reservedrooms;
    }

    public function updateMyReservedRoom($reservation_id, $data){     
        $this->model->where('reservation_id', '=', $reservation_id)->delete();        
        $this->model->insert($data);
    }

    
}
