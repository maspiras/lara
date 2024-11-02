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
}
