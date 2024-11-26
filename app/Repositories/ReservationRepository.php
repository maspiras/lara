<?php

namespace App\Repositories;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ReservationRepository extends BaseRepository
{
    #protected $model = Reservation::class;
    /* public function __construct()
    {
        $this->model = $model;
    } */
    protected $model;
    /* public function __construct(Reservation $model)
    {
        $this->model = $model;
    } */

    public function __construct()
    {
        $this->model = DB::table('reservations');
    }

    public function getMyReservation($id){
        $cache_keyword = 'reservation_id_'.$id;	
		$data = cache($cache_keyword);        
		if(is_null($data)){	
            $data = $this->model #distinct()->select(['reserved_services.reservation_id', 'reserved_services.host_id', 'reserved_services.user_id', 'reserved_services.service_id', 'services.service_name','reserved_services.amount', 'reserved_services.paymentstatus'])
            ->select(['reservations.id as id', 'reservations.ref_number', 'reservations.checkin as checkin', 'reservations.checkout as checkout', 'reservations.adults as adults', 'reservations.childs as childs', 'reservations.pets as pets', 'reservations.fullname as fullname', 'reservations.phone as phone', 'reservations.email as email', 'reservations.additional_info as additional_info', 'reservations.booking_source_id as booking_source_id', 'reservations.doorcode as doorcode', 'reservations.rateperday as rateperday', 'reservations.daystay as daystay', 'reservations.meals_total as meals_total', 'reservations.additional_services_total as additional_services_total', 'reservations.subtotal as subtotal', 'reservations.discount as discount', 'reservations.tax as tax', 'reservations.grandtotal as grandtotal', 'reservations.payment_type_id as payment_type_id', 'reservations.prepayment as prepayment', 'reservations.payment_status_id as payment_status_id', 'reservations.balancepayment as balancepayment', 'reservations.user_id as user_id', 'reservations.host_id as host_id', 'reservations.booking_status_id as booking_status_id', 'reservations.currency_id as currency_id', 
                    'currencies.currency_code as currency_code', 'currencies.currency_name as currency_name',  'currencies.currency_country as currency_country',  'currencies.currency_symbol as currency_symbol',
                    'booking_sources.source_name as source_name',
            ])    
                ->leftJoin('currencies', 'reservations.currency_id', '=', 'currencies.id')
                ->leftJoin('booking_sources', 'reservations.booking_source_id', '=', 'booking_sources.id')
                ->where('reservations.id', '=', $id)
                ->first();
		    cache([$cache_keyword => $data], 86400); 
		}
		return $data;        

    }

    
}
