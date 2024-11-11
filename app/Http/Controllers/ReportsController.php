<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\ReportsRepository;

class ReportsController extends Controller
{
    private $r, $reportsRepository;
    public function __construct(ReportsRepository $reportsRepository,Request $r){
        $this->r = $r;
        $this->reportsRepository = $reportsRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thismonth = $this->reportsRepository->getDailySales();
        $lastmonth = $this->reportsRepository->getMonthlySales();
        
        
        return view('reports.index', compact('thismonth', 'lastmonth'));
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
