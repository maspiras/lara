<?php

namespace App\Repositories;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class PaymentRepository extends BaseRepository
{
    protected $model;
    
    public function __construct()
    {
        $this->model = DB::table('payments');
    }

    
}
