<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use App\Repositories\ReportsRepository;

class ReportsController extends Controller
{
    private $reportsRepository;
    var $r;
    public function __construct(ReportsRepository $reportsRepository,Request $r){
        $this->reportsRepository = $reportsRepository;
        $this->r = $r;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        switch ($this->r->option) {
            case 'sales':
                return $this->sales();
                break;
            case 'checkin':
                echo "checkin";
                break;
            case 'checkout':
                echo "checkout";
                break;
            default:
                return $this->sales();
        }        
    }

    public function sales(){
        echo $this->r->option.' x '.$this->r->oid;
        //return view('reports.index');
    }

    
}
