<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use App\Repositories\ReportsRepository;

class DashBoardController extends Controller
{
    private $reportsRepository;
    public function __construct(ReportsRepository $reportsRepository,Request $r){
        $this->reportsRepository = $reportsRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thismonth = $this->reportsRepository->getSales(Carbon::now()->startOfMonth(),  Carbon::now());
        $lastmonth = $this->reportsRepository->getSales(Carbon::now()->startOfMonth()->subMonthsNoOverflow(), Carbon::now()->subMonthsNoOverflow()->endOfDay());
        $thisyear = $this->reportsRepository->getSales(Carbon::now()->startOfYear(),  Carbon::now(), '1 month', '');
        $lastyear = $this->reportsRepository->getSales(Carbon::now()->startOfYear()->subYearsNoOverflow(),  Carbon::now()->subYearsNoOverflow()->endOfDay(), '1 month', '');             
        $thismonthtotalsales = 0;
        foreach($thismonth['data'] as $v){
            $thismonthtotalsales += $v->amount;
        }

        $lastmonthtotalsales = 0;
        foreach($lastmonth['data'] as $v){
            $lastmonthtotalsales += $v->amount;
        }
        
        $thismonthtotalsalespercent = 0;
        if($lastmonthtotalsales >= 1){
            $thismonthtotalsalespercent = (($thismonthtotalsales-$lastmonthtotalsales) / $lastmonthtotalsales)*100;        
        }else{
            $thismonthtotalsalespercent = $thismonthtotalsales;
        }

        $thisyeartotalsales = 0;
        foreach($thisyear['data'] as $v){
            $thisyeartotalsales += $v->amount;
        }

        $lastyeartotalsales = 0;
        foreach($lastyear['data'] as $v){
            $lastyeartotalsales += $v->amount;
        }

        $thisyeartotalsalespercent = 0;
        if($lastyeartotalsales >= 1){
            $thisyeartotalsalespercent = (($thisyeartotalsales-$lastyeartotalsales) / $lastyeartotalsales)*100;
        }else{
            $thisyeartotalsalespercent = $thisyeartotalsales;
        }

        $salespercent = [
            'thismonthtotalsalespercent' => $thismonthtotalsalespercent,
            'thisyeartotalsalespercent' => $thisyeartotalsalespercent
        ];


        return view('default.dashboard', compact('thismonth', 'lastmonth', 'thisyear', 'lastyear', 'salespercent', 'thismonthtotalsales', 'thisyeartotalsales'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
