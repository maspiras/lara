<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ServiceRepository;

class APIServiceController extends Controller
{
    private $r, $serviceRepository;
    public function __construct(ServiceRepository $serviceRepository, Request $r)
    {        
        $this->r = $r;
        $this->serviceRepository = $serviceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        return $this->serviceRepository->getServices($this->r->host_id);  
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
