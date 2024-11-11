<?php

namespace App\Repositories;
use App\Models\ReservedRoom;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
class ReportsRepository extends BaseRepository
{    
    
    public function __construct()
    {   
         
         /*
        #$this->model = DB::table('reserved_rooms');
        switch($r->option){
            case 'sales':
                $this->model = DB::table('reservation');
                return getSales();
            break;
			
			default:	
		}     */
    }

    public function getDailySales(){
        return $thismonth = CarbonPeriod::create(Carbon::now()->startOfMonth(), '1 day', Carbon::now());
        
    }

    public function getMonthlySales(){
        return $lastmonth = CarbonPeriod::create(Carbon::now()->startOfMonth()->subMonthsNoOverflow(), '1 day', Carbon::now()->subMonthsNoOverflow()->endOfDay());
    }



    

}
