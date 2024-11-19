@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <h1 class="m-0">Reservations</h1>
                </div><!-- /.col -->
                <div class="col-sm-3">                
                    <div class="pull-right">
                        @can('room-create')                        
                        <a class="btn btn-success" href="{{ route('reservations.create') }}"><i class="fa fa-plus"></i> Create New Reservation</a>&nbsp;                                                
                        @endcan
                    </div>    
                </div>
                <div class="col-sm-3">
                  @session('success')
                      <div class="alert alert-success" role="alert"> 
                          {{ $value }}
                      </div>
                  @endsession            
                </div> 
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reservations</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->    
    
    <section class="content">
    <form method="post" id="reservationForm" action="{{ route('reservations.update', $reservation->id) }}">
    @csrf              
    @method('PUT')
      @if ($errors->any())
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          </div>
        </div>
      @endif
      @session('error')          
          <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                {{ $value }}
            </div>
          </div>
        </div>
      @endsession
      <div class="row">
        <div class="col-md-6">
        <div class="card roomlistcard card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Room/s</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                  <div class="row">
                  
                    @foreach($rooms as $room)
                                    
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group clearfix">
                        <div class="icheck-success d-inline">
                          <input type="checkbox" id="roomname{{$room->id}}" name="roomname[]" class="rooms" value="{{$room->id}}" {{ (is_array($myReservedRooms) && in_array($room->id, $myReservedRooms)) ? ' checked' : '' }}>
                          <label for="roomname{{ $room->id}}">
                            {{ $room->room_name }}
                          </label>
                        </div>
                      </div>
                    </div>
                    @endforeach  

                    
                  </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Details: {{ $reservation->fullname }}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Checkin</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend" data-target="#checkin" data-toggle="checkin">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div> 
                        <input type="text" required id="checkin" name="checkin" class="form-control" placeholder="mm/dd/yyyy" value="{{ date('m/d/Y', strtotime($reservation->checkin)) }}">
                                           
                    </div>                
              </div>
              <div class="form-group">
                <label for="inputName">Checkout</label>
                    <!-- <div class="input-group date" id="reservationcheckout" data-target-input="nearest">
                        <input type="text" required id="checkout" name="checkout" class="form-control datetimepicker-input" data-target="#reservationcheckout" placeholder="mm/dd/yyyy" value="{{ $reservation->checkout }}"  />
                        <div class="input-group-append" data-target="#reservationcheckout" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div> -->       
                    <div class="input-group mb-3">
                        <div class="input-group-prepend" data-target="#checkout" data-toggle="">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" required id="checkout" name="checkout" class="form-control" placeholder="mm/dd/yyyy" value="{{ date('m/d/Y', strtotime($reservation->checkout)) }}">
                    </div>           
              </div>
              
              <div class="form-group">
                <label for="adults">Adults</label>
                <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-user"></i></span>
                        </div>
                        <select id="adults" name="adults" class="form-control custom-select">
                        <option selected value="{{ $reservation->adults }}">{{ $reservation->adults }}</option>
                        @for ($a = 0; $a <= 300; $a++)
                        <option value="{{ $a }}"> {{ $a }}</option>
                        @endfor
                        </select>
                    </div>
              </div>
              <div class="form-group">
                    <label for="childs">Childs</label>                
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-user"></i></span>
                        </div>
                        <select id="childs" name="childs" class="form-control custom-select">
                        <option selected value="{{ $reservation->childs }}">{{ $reservation->childs }}</option>
                        @for ($c = 0; $c <= 100; $c++)
                        <option value="{{ $c }}"> {{ $c }}</option>
                        @endfor
                        </select>
                    </div>
              </div>
              <div class="form-group">
                <label for="pets">Pets</label>
                <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-cat"></i></span>
                        </div>
                        <select id="pets" name="pets" class="form-control custom-select">
                        <option selected value="{{ $reservation->pets }}">{{ $reservation->pets }}</option>
                        @for ($p = 0; $p <= 50; $p++)
                        <option value="{{ $p }}"> {{ $p }}</option>
                        @endfor
                        </select>
                    </div>
              </div>
              
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
          


            <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Guest Information</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="fullname">Name</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" required id="fullname" name="fullname" placeholder="Name" value="{{ $reservation->fullname }}" />
                </div>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" value="{{ $reservation->phone }}" />
                </div>

              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ $reservation->email }}" />
                </div>

              </div>
              
              <div class="form-group">
                <label for="additionalinformation">Additional information</label>
                <textarea id="additionalinformation" name="additionalinformation" class="form-control" rows="4" placeholder="Additional information" >{{ $reservation->additional_info }}</textarea>
              </div>

              <div class="form-group">
                  <label>Booking Source</label>
                  <select class="form-control select2" style="width: 100%;" id="bookingsource" name="bookingsource_id">
                    <option selected value="{{ $reservation->booking_source_id }}">{{ $reservation->booking_source_id }}</option>
                    <option value="10">Other</option>
                    <option value="1">Phone</option>
                    <option value="2">Walkin</option>
                    <option value="3">Facebook/Messenger/FB Page</option>
                    <option value="4">Tiktok</option>
                    <option value="5">Instagram</option>                    
                    <option value="6">Email</option>
                    <option value="7">Booking.com</option>
                    <option value="8">Airbnb</option>
                    <option value="9">Website</option>                    
                  </select>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
        </div>
        <div class="col-md-6">
          
          
          <!-- Start Rates -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Rates</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget">Rates per day</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input type="number"step=".01" id="ratesperday" name="ratesperday" class="form-control" placeholder="0.00" value="{{ $reservation->rateperday }}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputSpentBudget">Days stay</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-moon"></i></span>
                  </div>
                  <input readonly type="text" class="form-control" placeholder="1" value="{{ $reservation->daystay }}" name="daystay" id="daystay">
                </div>

              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Rates per stay</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input type="text" id="ratesperstay" name="ratesperstay" class="form-control" placeholder="0.00" value="{{ $reservation->grandtotal }}">
                </div>

              </div>
              
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- End Rates -->

          <!-- Start payment -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Payment</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

              <div class="form-group">
                  <label>Currency</label>
                  <select class="form-control select2" style="width: 100%;" id="currency" name="currency">
                    <option selected value="{{ $reservation->currency_id }}">{{ $reservation->currency_id }}</option>
                    <option value="1">PHP</option>
                    <option value="2">PHP</option>
                    <option value="3">USD</option>
                    <option value="4">EUR</option>                    
                    <option value="5">CAD</option>
                    <option value="6">AUD</option>
                    <option value="7">GBP</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>Payment status</label>
                  <select class="form-control select2" style="width: 100%;" id="paymentstatus" name="paymentstatus">
                    <option selected value="{{ $reservation->payment_status_id }}">{{ $reservation->payment_status_id }}</option>
                    <option value="1">No payment</option>
                    <option value="2">Prepayment paid</option>
                    <option value="3">Fully paid</option>                 
                  </select>
              </div>  

              <div class="form-group">
                  <label>Type of payment</label>
                  <select class="form-control select2" style="width: 100%;" id="typeofpayment" name="typeofpayment">
                    <option selected value="{{ $reservation->payment_type_id }}">{{ $reservation->payment_type_id }}</option>
                    <option value="0">Select</option>
                    <option value="1">Pay with cash</option>
                    <option value="2">Pay via online money transfer</option>
                    <option value="3">Pay via debit/credit card</option>
                    <option value="4">Pay via Cheque</option>
                  </select>
              </div>  

              <div class="form-group">
                <label for="inputEstimatedDuration">Prepayment</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input type="text" class="form-control" id="prepayment" name="prepayment" placeholder="0.00" value="{{ $reservation->prepayment }}" />
                </div>
              </div>

              

              
              
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- End payment -->

          <div class="col-12">
                  
                  <button type="submit" class="btn btn-success btn-lg float-right"><i class="far fa-credit-card"></i> Save Reservation
                  </button>
                  <button type="cancel" class="btn btn-secondary btn-lg float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Cancel Reservation
                  </button>
                </div>

          <!-- /.card -->
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div> -->
      </form>
    </section>
    <!-- /.content -->
  
</div>


@endsection
@push('styles')
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  
@endpush
@push('scripts')
<script src="{{ url('/') }}/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('/') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="{{ url('/') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- date-range-picker -->
<script src="{{ url('/') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- jquery-validation -->
<script src="{{ url('/') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/') }}/plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript" src="{{ url('/') }}/js/reservation.js"></script>

<script>
 $(function () {
    var Reservation = {
      DayStay: function(checkin, checkout){
        var d1 = new Date(checkin);   
        var d2 = new Date(checkout);       
        var diff = ( d2.getTime() - d1.getTime() ) / (1000 * 60 * 60 * 24);              
        $('#daystay').val(diff);
        //e.preventDefault();
      },
      RatesPerDay: function(frm, e){        
        if($('#daystay').val() == 0){
          $('#ratesperstay').val($('#ratesperday').val());
        }else{          
          $('#ratesperstay').val((Math.round($('#ratesperday').val() * $('#daystay').val() * 100) / 100).toFixed(2));
        }
        
      },
      RatesPerStay: function(frm, e){                
        $('#ratesperday').val((Math.round($('#ratesperstay').val() / $('#daystay').val() * 100) / 100).toFixed(2));
      },
      DateRangePicker: function(input, checkin){
        input.daterangepicker({
          singleDatePicker: true,
          autoApply: true,
          minDate: checkin
        }, function(checkout, end1, label1) {                
          Reservation.DayStay($('#checkin').val(), moment(checkout).format('MM/DD/YYYY') );
            Reservation.RatesPerDay(); 
          }
        );
      }
    }

    $('#ratesperday').on('change keyup', function() {
      Reservation.RatesPerDay();
    });

    $('#ratesperstay').on('change keyup', function() {
      Reservation.RatesPerStay();
    });

    $('#reservationForm').submit(function(e){
      if($('#reservationForm input:checked').length <= 0){
          $('.roomlistcard').removeClass('card-primary');
          $('.roomlistcard').addClass('card-danger');
          $('.roomlistcard div h3').text('Room/s: This field is required');    
          e.preventDefault();        
        }else{
          $('.roomlistcard').removeClass('card-danger');
          $('.roomlistcard').addClass('card-primary');
          $('.roomlistcard div h3').text('Room/s');
          
        }
        //e.preventDefault();
        
    });

  
 
   
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  
    //alert(moment().format('YYYY/MM/DD'));
    $('input[name="checkin"]').daterangepicker({
      singleDatePicker: true,
      autoApply: true,
      minDate: moment().add(0, 'days')
      
    }, function(checkin, end, label) {  
      var a = moment(checkin);
      var dateObj = new Date($('#checkout').val());
      var b = moment(dateObj);
      
var days = b.diff(a, 'days'); 
var checkout = $('#checkout').val();
if(days <=0 ){
  checkout = checkin;
  days = 0;
  $('#checkout').val(moment(checkin).format('MM/DD/YYYY'));
}
var newcheckoutObj = new Date($('#checkout').val());
var newcheckout = moment(newcheckoutObj);
var days = newcheckout.diff(a, 'days'); 
if(days <=0 ){ 
  days = 0; 
}
//alert(days + ' x checkin ' + moment(checkin).format('MM/DD/YYYY') + ' xcheckout' + $('#checkout').val());
//alert(checkout);
        Reservation.DayStay(moment(checkin).format('MM/DD/YYYY'), $('#checkout').val());        
        Reservation.RatesPerDay();  
        /*
        $('#checkout').daterangepicker({
          singleDatePicker: true,
          autoApply: true,
          minDate: checkin//moment().add(0, 'days')
        }, function(checkout, end1, label1) {   
                     
            //Reservation.DayStay(moment(checkin).format('MM/DD/YYYY'), moment(checkout).format('MM/DD/YYYY') );
            Reservation.DayStay($('#checkin').val(), moment(checkout).format('MM/DD/YYYY') );
            Reservation.RatesPerDay(); 
          }
        );
        */

        Reservation.DateRangePicker($('#checkout'), checkin); 
      }
    );

    /* $('input[name="checkout"]').daterangepicker({
      singleDatePicker: true,
      autoApply: true,
      minDate: $('#checkin').val()//moment().add(0, 'days')
    }, function(start, end, label) {      
      Reservation.DayStay($('#checkin').val(), start );
      Reservation.RatesPerDay(); 
      }
    ); */
    Reservation.DateRangePicker($('#checkout'),  $('#checkin').val()); 
    
  }) 
</script>
@endpush