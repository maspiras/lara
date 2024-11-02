<?php

namespace App\Repositories;
use App\Models\Reservation;

class ReservationRepository extends BaseRepository
{
    #protected $model = Reservation::class;
    /* public function __construct()
    {
        $this->model = $model;
    } */
    protected $model;
    public function __construct(Reservation $model)
    {
        $this->model = $model;
    }
}
