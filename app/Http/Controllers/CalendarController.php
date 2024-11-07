<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\ReservedRoomRepository;
use App\Repositories\RoomRepository;
use Carbon\Carbon;
#use Illuminate\Database\Eloquent\Collection;
#use App\Models\Room;
class CalendarController extends Controller
{
    
    private $reservedRoomRepository, $roomRepository;

    public function __construct(ReservedRoomRepository $reservedRoomRepository, RoomRepository $roomRepository)
    {        
        $this->roomRepository = $roomRepository;
        $this->reservedRoomRepository = $reservedRoomRepository;
    }
    /**
     * Display a listing of the resource.
     */        
    public function index()
    {        
        $rooms =  $this->roomRepository->all();       
        
        $reservedrooms = $this->reservedRoomRepository->where(Carbon::create(date('Y-m-d', strtotime("-1 month")))->startOfMonth(), Carbon::create(date('Y-m-d', strtotime("+13 months")))->endOfMonth());
        return view('calendar.index',compact('rooms', 'reservedrooms'))
            ->with('i', (request()->input('page', 1) - 1) * 5); 
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
