<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

use App\Repositories\ServiceRepository;

class ServiceController extends Controller
{
    private $r, $serviceRepository;

    
    public function __construct(ServiceRepository $serviceRepository, Request $r)
    {        
        $this->serviceRepository = $serviceRepository;
        $this->r = $r;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store()
    {
        $msg = "Successfully Saved";
        $status = null;
        DB::beginTransaction();
        try {                        
            $this->serviceRepository->insert($this->formData());            
            $status = 1;            
            DB::commit(); 
        } catch(\Exception $e) {
            DB::rollBack();            
            $msg = 'Duplicate entry or Something went wrong.'; #$e->getMessage();
        }       
        return array('status' => $status, 'msg' => $msg);
    }

    public function formData(){
        $data = array(            
            'user_id' => $this->r->user()->id,
            'host_id' => auth()->user()->host_id,
            'service_name' => $this->r->servicename,
            'service_desc' => $this->r->servicedesc,
            'period' => $this->r->serviceperiod,
            'payment' => $this->r->servicepayment,
            'amount' => $this->r->serviceprice,            
        );
        return $data;
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
