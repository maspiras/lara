<?php

namespace App\Repositories;
use App\Models\ReservedRoom;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

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
        return $this->model->distinct()
        ->select(['reserved_rooms.id as id', 'reserved_rooms.room_id as room_id', 'rooms.room_name as room_name'
            ])    
                ->leftJoin('rooms', 'reserved_rooms.room_id', '=', 'rooms.id')
        ->where('reservation_id', '=', $id)->get();
        
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
        /* $this->model->where('reservation_id', '=', $reservation_id)->chunkById(1000, function ($reservedrooms) {
            //go through the collection and delete every post.
            foreach($reservedrooms as $r) {
                $r->delete();
            }
        }); */
                
        $this->model->insert($data);
    }

    
}
