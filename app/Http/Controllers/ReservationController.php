<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Repositories\ReservationRepository;
use App\Repositories\RoomRepository;

use Illuminate\Foundation\Validation\ValidatesRequests;

class ReservationController extends Controller
{
    use ValidatesRequests;
    private $reservationRepository;
    private $roomRepository;
    public function __construct(ReservationRepository $reservationRepository, RoomRepository $roomRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->roomRepository = $roomRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = array();#$this->bookingRepository->getPaginate(5);        
        
        return view('reservations.index',compact('reservations'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = $this->roomRepository->all();
        #$rooms = $this->roomRepository->getPaginate(2);   
        return view('reservations.create',compact('rooms'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     */    
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'prepayment' => 'required',
        ]);
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
