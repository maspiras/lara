<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Repositories\ReservationRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ReservedRoomRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\ReservedMealRepository;
use App\Repositories\ReservedServiceRepository;

use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\ReservationRequest;

use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use DataTables;
use App\DataTables\ReservationsDataTable;
use Illuminate\Database\Query\Builder;


class ReservationController extends Controller
{
    use ValidatesRequests;
    private $reservationRepository, $reservedRoomRepository, $paymentRepository, $serviceRepository, $reservedmealRepository;
    private $roomRepository, $reservedserviceRepository;
    
    public function __construct(ReservedServiceRepository $reservedserviceRepository, ReservedMealRepository $reservedmealRepository, ServiceRepository $serviceRepository, PaymentRepository $paymentRepository, ReservedRoomRepository $reservedRoomRepository, ReservationRepository $reservationRepository, RoomRepository $roomRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->roomRepository = $roomRepository;
        $this->reservedRoomRepository =  $reservedRoomRepository;
        $this->paymentRepository = $paymentRepository;
        $this->serviceRepository = $serviceRepository;
        $this->reservedmealRepository = $reservedmealRepository;
        $this->reservedservicesRepository = $reservedserviceRepository;
    }

    /**
     * Display a listing of the resource.
     */
    
    public function index(ReservationsDataTable $dataTable)
    {
        
        #$rooms =  $this->roomRepository->all();
        #array();#$this->bookingRepository->getPaginate(5);  
    
        #$reservedrooms = $this->reservedRoomRepository->where(Carbon::now()->year, Carbon::now()->month);
        #$reservedrooms = $this->reservedRoomRepository->where(Carbon::create(date('Y-m-d', strtotime("-1 month")))->startOfMonth(), Carbon::create(date('Y-m-d', strtotime("+13 months")))->endOfMonth());
        

        /* $show = '';
        $dates = 0;        
        
        for($i=0; $i < 31; $i++){         
            foreach($reservedrooms as $rr){
                if($rr->reserved_dates == $i){
                    if($dates == 0){
                        $show .= '<td>'.$rr->fullname.'x'.$dates.'x'.$i;
                        $dates = $i;
                    }elseif($dates != $i){
                        $show .= '</td><td>'.$rr->fullname.'xxx'.$dates.'x'.$i;
                        $dates = $i; 
                    }else{
                        $show .= '<br>'.$rr->fullname.'xi'.$dates.'x'.$i.'</td>';
                        $dates = 0;
                    }            
                }
            }            
        }        
        $show .= '</td>';
        $showreservations = $show; */
        
        #echo substr_replace($showrooms, '', -1);
        

        #echo $bookedrooms;

        /* if(request()->ajax()){
            $data = $this->reservationRepository->latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.$row['id'].'" class="edit btn btn-success btn-sm">Edit</a> <a href="'.$row['id'].'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } */
        
        #return view('reservations.index');
        return $dataTable->render('reservations.index');
        #print_r($data);
        

        /* return view('reservations.index',compact('rooms', 'reservedrooms'))
            ->with('i', (request()->input('page', 1) - 1) * 5);  */
           
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = $this->serviceRepository->getServices(auth()->user()->host_id);       
        /* //foreach($services as $service => $v){
        foreach($services as $service => $v){            
            echo $v['service_name'].'<br>';
            #echo $service->service_name.'<br>';
        } 
        exit; */
        $rooms = $this->roomRepository->all();
        #$rooms = $this->roomRepository->getPaginate(2);   
        $myReservedServices = [];
        return view('reservations.create',compact('rooms', 'services', 'myReservedServices'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function reservationData($request){
        $checkin = date('Y-m-d H:i:s', strtotime($request->checkin.' 2pm'));
        $checkout = date('Y-m-d H:i:s', strtotime($request->checkout.' 12pm'));

        $data['reservation'] = array(
            'checkin' => $checkin,
            'checkout' => $checkout,
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
            'host_id' => auth()->user()->host_id,
            
            #'booking_status_id' => $request->booking_status_id,            
        );

        $data['roomname'] = $request->roomname;

        return $data;
    }

    public function mealsRequestData($request, $reservation_id=null){
        $mealData = array(
            'host_id' => auth()->user()->host_id,
            'user_id' => auth()->user()->id,
            'reservation_id' => $reservation_id,
            'meal_name' => $request->meals,
            'meal_adults' => $request->mealsadults,
            'meal_childs' => $request->mealschilds,
            'amount' => $request->mealsamount,
        );
        return $mealData;
    }

    public function servicesRequestData($request, $reservation_id=0){
        $reservedservices = [];
       # $reservedservicestotal = 0;
        $i = 0;        
        foreach($request->service_id as $id){
            $reservedservices[] = ['host_id' => auth()->user()->host_id,
            'user_id' => auth()->user()->id,
            'reservation_id' => $reservation_id,
            'service_id' => $id,
            'amount' => $request->servicesamount[$i],
            'paymentstatus' => $request->servicepaymentstatus[$i],
            ];
            #$reservedservicestotal += $request->servicesamount[$i];
            $i++;
        }
        #$reservedservices['amount'] = $reservedservicestotal;
        
        return $reservedservices;
    }

    public function getReservationGrandTotal($rooms, $meals=0, $services=0){
        if(!empty($services)){            
            $services = str_replace(',','', $services);
        }
        if(!empty($meals)){
            $meals = str_replace(',','', $meals);
        } 
        /* $services = empty($services) ? 0 : $services;        
        $meals = empty($meals) ? 0 : $meals; */
        return $rooms + $meals + $services;
    }

    public function isEmpty($data){
        $result = true;
        if(isset($data)){
            if($data === '0' || $data === 0 ||
               $data === 0.0 || $data) {
              // not empty: use the value
              $result = false;
            } /* else {
              // consider it as empty, since status may be FALSE, null or an empty string
              return true;
            } */
        }
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     */    
    
    #public function store(Request $request)
    public function store(ReservationRequest $request)#: RedirectResponse
    {
        #echo $this->getReservationGrandTotal($request->ratesperstay, $request->mealsamount, $request->servicestotalamount);
        
        /* if($request->mealsamount){
            echo 'meron';
        }else{
            echo 'wala';
        } */

    /*     $servicesRequestData = $this->servicesRequestData($request);
        $this->reservedservicesRepository->insert($servicesRequestData);
        exit; */
        
        $validated = $request->validated();
       /*  $checkin = date('Y-m-d H:i:s', strtotime($request->checkin.' 2pm'));
        $checkout = date('Y-m-d H:i:s', strtotime($request->checkout.' 12pm')); */
        
        $checkin = Carbon::parse($request->checkin.' 2pm');
        $checkout = Carbon::parse($request->checkout.' 12pm');
        $diff = $checkin->diffInDays($checkout);
        

       // return $checkin.' - '.$checkout;
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

        //dd($request->prepayment);
        $grandtotal = $this->getReservationGrandTotal($request->ratesperstay, $request->mealsamount, $request->servicestotalamount);
        $payment_status = 1;
        $balance = 0;
        $amount = 0;

        if(!empty($request->prepayment)){
           if($request->prepayment >= $grandtotal){
                $payment_status = 3;
                $balance = 0;
                $amount = $grandtotal;
           }else{
                $balance = $grandtotal - $request->prepayment;
                $payment_status = 2;
                $amount = $request->prepayment;
           }
        }
            /*  Hard check for empty  */            
        /* if(isset($web['status'])){
            if($web['status'] === '0' || $web['status'] === 0 ||
               $web['status'] === 0.0 || $web['status']) {
              // not empty: use the value
            } else {
              // consider it as empty, since status may be FALSE, null or an empty string
            }
          } */
        
        $ref_number = time().'-'.$request->user()->id;
        $reservationdata = array(
                        'ref_number' => $ref_number,
                        'checkin' => $checkin,
                        'checkout' => $checkout,
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
                        'daystay' => $diff,
                        'meals_total' => $request->mealsamount,
                        'additional_services_total' => $request->servicestotalamount,
                        'subtotal' => $request->ratesperstay,
                        #'discount' => $request->discount,
                        #'tax' => $request->tax,
                        'grandtotal' => $grandtotal, 
                        'currency_id' => $request->currency,
                        'payment_type_id' => $request->typeofpayment,
                        'prepayment' => $request->prepayment,
                        'payment_status_id' => $payment_status,
                        'balancepayment' => $balance,
                        'user_id' => $request->user()->id,
                        'host_id' => auth()->user()->host_id,
                        'booking_status_id' => empty($request->prepayment) ? 0 : 1,                        
                );
        
                      
        DB::beginTransaction();
        try {            
            $reservation = $this->reservationRepository->store($reservationdata);
                            
            $reservedroomsdata = [];
            $period = CarbonPeriod::create($checkin, '1 hour', $checkout);
            $reserved_dates = [];
            foreach ($period as $date) {            
                $reserved_dates[] = $date->format('Y-m-d H:i');
                foreach($request->roomname as $bookedrooms){
                    $reservedroomsdata[] = ['reservation_id' => $reservation->id, 'room_id' => $bookedrooms, 'reserved_dates' =>$date->format('Y-m-d H:i') ];
                }                
            }
            
            $this->reservedRoomRepository->insert($reservedroomsdata);
            
            
            $paymentData = array(
                'ref_number' => $ref_number,
                'host_id' => auth()->user()->host_id,
                'user_id' => $request->user()->id,
                'reservation_id' => $reservation->id,
                'amount' => $amount,
                'balance' => $balance                
            );  
            #if(!empty($request->prepayment)){
            if(!$this->isEmpty($request->prepayment)){
                $this->paymentRepository->insert($paymentData);
            }

            #if(!empty($request->meals)){                
            if(!$this->isEmpty($request->meals)){    
                $this->reservedmealRepository->insert($this->mealsRequestData($request, $reservation->id));
            }   
                        
            #if(!empty($request->service_id)){
            if(!$this->isEmpty($request->service_id)){
                $this->reservedservicesRepository->insert($this->servicesRequestData($request, $reservation->id));
            }
        
            
            DB::commit(); 
        } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->route('reservations.create')->with('error', 'Room/s occupied');

        }  

        return redirect()->route('reservations.index')->with('success','Reservation created successfully!');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('reservations.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       
        $reservation = $this->reservationRepository->find($id);
        $rooms = $this->roomRepository->all();
        
        #$bookedrooms = [];
        /* foreach($reservation->reservedRooms() as $r){
            $bookedrooms[]= $r->room_id.'<br>';
        } */
        #print_r($reservation->with('reservedRooms')->get());
        #$reservedRooms = $reservation->reservedRooms()->groupBy('room_id')->get();
        #$reservedRooms = $reservation->reservedRooms;  
        $services = $this->serviceRepository->getServices(auth()->user()->host_id);                            
        $reservedServices = $this->reservedservicesRepository->getMyReservedServices($id);
        $myReservedServices = [];
        foreach($reservedServices as $r){
            $myReservedServices[] = $r->service_id;
        }
        $myReservedServices = array_unique($myReservedServices);        

        $reservedRooms = $this->reservedRoomRepository->getMyReservedRooms($id);
        $myReservedRooms = [];
        foreach($reservedRooms as $r){
            $myReservedRooms[] = $r->room_id;
        }
        $myReservedRooms = array_unique($myReservedRooms);
        #print_r($myReservedRooms);

        #exit;
        return view('reservations.edit', compact('reservation', 'rooms', 'myReservedRooms', 'services', 'myReservedServices'));
        #print_r($reservation->id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation_id = last(request()->segments());
        $data = $this->reservationData($request);

        #dd($data['reservation']['checkin']);
        #exit;
       
        DB::beginTransaction();
        try {   
            
            
            $this->reservationRepository->update($reservation_id, $data['reservation']);
            #dd($data['reservation']);
            
            
            #$checkin = date('Y-m-d H:i:s', strtotime($request->checkin.' 2pm'));
            #$checkout = date('Y-m-d H:i:s', strtotime($request->checkout.' 12pm'));                
            $reservedroomsdata = [];
            $period = CarbonPeriod::create($data['reservation']['checkin'], '1 hour', $data['reservation']['checkout']);
            
            $reserved_dates = [];
            foreach ($period as $date) {            
                $reserved_dates[] = $date->format('Y-m-d H:i');
                foreach($request->roomname as $bookedrooms){
                    $reservedroomsdata[] = ['reservation_id' => $reservation_id, 'room_id' => $bookedrooms, 'reserved_dates' =>$date->format('Y-m-d H:i') ];
                }                
            }   
            
            $this->reservedRoomRepository->updateMyReservedRoom($reservation_id, $reservedroomsdata);
            #$this->reservedRoomRepository->update($reservation_id, $reservedroomsdata );
            
            DB::commit(); 
         } catch(\Exception $e) {
                DB::rollBack();
                return redirect()->route('reservations.edit', $reservation_id)->with('error', 'Room/s occupied');
                //return $reservation_id;

        } 

        
        return redirect()->route('reservations.edit', $reservation_id)->with('success','Reservation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
