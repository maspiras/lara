<?php

namespace App\Repositories;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Collection;

class ReservedServiceRepository extends BaseRepository
{
    protected $model;
    
    public function __construct()
    {
        $this->model = DB::table('reserved_services');
    }
}
