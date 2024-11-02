<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Repositories\ReservationRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ReservedRoomRepository;

use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    use ValidatesRequests;
    private $reservationRepository, $reservedRoomRepository;
    private $roomRepository;
    
    public function __construct(ReservedRoomRepository $reservedRoomRepository, ReservationRepository $reservationRepository, RoomRepository $roomRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->roomRepository = $roomRepository;
        $this->reservedRoomRepository = $reservedRoomRepository;
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
    public function store(ReservationRequest $request)#: RedirectResponse
    {
        /* request()->validate([
            #'prepayment' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'fullname' => 'required',

        ]); */

        /* $validated = $request->validate([
            //'title' => 'required|unique:posts|max:255',
            #'prepayment' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'fullname' => 'required|max:200',
            'roomname' => 'array|min:1|required',
            'roomname.*' => 'required|string'
        ]); */

            
        $validated = $request->validated();
        /*
        $reservationdata = array(
                        'checkin' => date('Y-m-d H:i:s', strtotime($request->checkin)),
                        'checkout' => date('Y-m-d H:i:s', strtotime($request->checkout)),
                        'adults' => $request->input('adults'),
                        'childs' => $request->input('childs'),
                        'pets' => $request->input('pets'),
                        'fullname' => $request->input('fullname'),
                        'phone' => $request->input('phone'),
                        'email' => $request->input('email'),
                        'additional_info' => $request->input('additionalinformation'),
                        'booking_source_id' => $request->input('bookingsource_id'),
                        'doorcode' => 0,
                        'rateperday' => $request->ratesperday,
                        'daystay' => $request->daystay,
                        #'meals_total' => 0,
                        #'additional_services_total' => 0,
                        'subtotal' => $request->ratesperstay,
                        #'discount' => $request->discount,
                        #'tax' => $request->tax,
                        'grandtotal' => $request->ratesperstay,
                        'currency_id' => $request->currency,
                        'payment_type_id' => $request->typeofpayment,
                        'prepayment' => $request->prepayment,
                        'payment_status_id' => $request->paymentstatus,
                        'balancepayment' => ($request->ratesperstay-$request->prepayment),
                        'user_id' => $request->user()->id,
                        'host_id' => 1,
                        #'booking_status_id' => $request->booking_status_id,
                        
                );
        $this->reservationRepository->store($reservationdata);
        $reservedroomsdata = array();
        $this->reservedRoomRepository->store($reservedroomsdata);
        */

        $reservedroomsdata = [];
        foreach($request->roomname as $bookedrooms){
            $reservedroomsdata[] = ['room_id' => $bookedrooms, 'reservation_id' => 100];
        }
        #print_r($reservedroomsdata);
        #$reservedroomsdata[] = ['room_id' => $bookedrooms];
        $this->reservedRoomRepository->insert($reservedroomsdata);
        #return redirect()->route('reservations.index')->with('success','Reservation created successfully!'.print_r($request->roomname));
       //return redirect()->route('reservations.index')->with('success',date('Y-m-d H:i:s', strtotime($request->checkin)));

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
