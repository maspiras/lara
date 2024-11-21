<?php

namespace App\Repositories;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
#use Illuminate\Support\LazyCollection;
#use Illuminate\Support\Collection;

class ReservedMealRepository extends BaseRepository
{
    protected $model;
    
    public function __construct()
    {
        $this->model = DB::table('reserved_meals');
    }

    public function getMyReservedMeals($id){       
        /* return $this->model
            #->leftJoin('services', 'reserved_services.service_id', '=', 'services.id')
            ->where('reservation_id', '=', $id)
            ->get(); */
            
        $cache_keyword = 'myReservedMeals_'.$id;	
        $data = cache($cache_keyword);        
        if(is_null($data)){	
            $data = $this->model->where('reservation_id', '=', $id)->first();
            cache([$cache_keyword => $data], now()->addDays(1)); 
        }
        return $data;    
    }

    

    
}
