@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reservations</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
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
    <form method="post" id="reservationForm" action="{{ route('reservations.update', $reservation->id) }}">
    @csrf
    @method('PUT')
    <section class="content"> 
    <div class="container-fluid">   
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
              <h3 class="card-title">Details:  {{ $reservation->fullname }}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <!-- <div class="form-group">
                <label for="inputName">Checkin</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" required id="checkin" name="checkin" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="mm/dd/yyyy" />
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>                
              </div> -->
              <div class="form-group">
                <label for="inputName">Checkin</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend" data-target="#checkin" data-toggle="checkin">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>                         
                        <input type="text" required id="checkin" name="checkin" class="form-control" placeholder="mm/dd/yyyy" value="{{ date('m/d/Y', strtotime($reservation->checkin)) }}">                                         
                    </div>                
              </div>
              <!-- <div class="form-group">
                <label for="inputName">Checkout</label>
                    <div class="input-group date" id="reservationcheckout" data-target-input="nearest">
                        <input type="text" required id="checkout" name="checkout" class="form-control datetimepicker-input" data-target="#reservationcheckout"  placeholder="mm/dd/yyyy" />
                        <div class="input-group-append" data-target="#reservationcheckout" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>                
              </div> -->
              <div class="form-group">
                <label for="inputName">Checkout</label>                     
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
              <h3 class="card-title">Room Rates</h3>

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
                  <input type="number" step=".01" id="ratesperday" name="ratesperday" class="form-control" placeholder="0.00" required value="{{ $reservation->rateperday }}">
                </div>
              </div>
              <div class="form-group">
                <label for="inputSpentBudget">Night/s stay</label>
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
                  <input type="number" step="any" id="ratesperstay" name="ratesperstay" class="form-control" placeholder="0.00" required value="{{ $reservation->subtotal }}">
                </div>

              </div>
              
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- End Rates -->

          @include('reservations.meals')

          @include('reservations.services')

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
                    <option selected value="{{ $reservation->currency_id }}">{{$reservation->currency_code}} - {{$reservation->currency_country}}</option>
                    <option value="251">USD - United States</option>
                    <option value="90">EUR - Europe</option>                    
                    <option value="42">CAD - Canada</option>
                    <option value="13">AUD - Australia</option>
                    <option value="249">GBP - United Kingdom</option>
                    @foreach($currencies as $c)
                    <option value="{{$c->id}}">{{$c->currency_code}} - {{$c->currency_country}}</option>
                    @endforeach
                  </select>
              </div>
              <!-- <div class="form-group">
                  <label>Payment status</label>
                  <select class="form-control select2" style="width: 100%;" id="paymentstatus" name="paymentstatus">
                    <option selected="selected" value="1">No payment</option>
                    <option value="2">Prepayment paid</option>
                    <option value="3">Fully paid</option>                 
                  </select>
              </div> -->  

              <div class="form-group">
                  <label>Type of payment</label>
                  <select class="form-control select2" style="width: 100%;" id="typeofpayment" name="typeofpayment">
                    <option selected value="{{ $reservation->payment_type_id }}">
                    @php                       
                      if($reservation->payment_type_id == 1){
                        echo 'Pay with cash';  
                      }elseif($reservation->payment_type_id == 2){
                        echo 'Pay via online money transfer';  
                      }elseif($reservation->payment_type_id == 3){
                        echo 'Pay via debit/credit card';  
                      }else{  
                        echo 'Pay via Cheque';  
                      }
                    @endphp
                    </option>
                    <option value="1">Pay with cash</option>
                    <option value="2">Pay via online money transfer</option>
                    <option value="3">Pay via debit/credit card</option>
                    <option value="4">Pay via Cheque</option>
                    
                  </select>
              </div>  
              <div class="form-group">
                <label for="inputEstimatedDuration">Grand Total</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input disabled type="text" class="form-control" placeholder="0.00" value="{{ $reservation->grandtotal }}" name="grandtotal" id="grandtotal">
                </div>
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Total Prepayment</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>                  
                  <input disabled type="number" class="form-control" id="prepayment" name="prepayment" placeholder="0.00" value="{{ $reservation->prepayment }}" />
                </div>
              </div>

              <div class="form-group">
                <label for="inputEstimatedDuration">Balance</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input disabled type="text" class="form-control" placeholder="0.00" value="{{ $reservation->balancepayment }}" name="balance" id="balance">
                </div>
              </div>
             
              

              

              
              
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- End payment -->

          <div class="col-12">
              <div class="form-group justify-content-md-center row">
                  
                  <div class="col col-6 text-center">
                      <button type="cancel" class="btn btn-secondary btn-lg"><i class="fas fa-download"></i> Cancel Reservation</button>
                  </div>
                  
                  <div class="col col-6 text-center">
                      <button type="submit" class="btn btn-success btn-lg"><i class="far fa-credit-card"></i> Save Reservation</button>
                  </div>
              </div>
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
      </div>
    </section>
    <!-- /.content -->
  </form>
</div> <!-- /.content-wrapper -->
@include('reservations.addservice')


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
    
    
    

    

    /* $.validator.setDefaults({
      submitHandler: function () {
        if($('#reservationForm input:checked').length <= 0){
          $('.roomlistcard').removeClass('card-primary');
          $('.roomlistcard').addClass('card-danger');
          $('.roomlistcard div h3').text('Room/s: This field is required');            
        }else{
          $('.roomlistcard').removeClass('card-danger');
          $('.roomlistcard').addClass('card-primary');
          $('.roomlistcard div h3').text('Room/s');
          alert( "Form successful submitted!" );
        }
        
      }
    }); */

    
    /* $('#ratesperday').on('input', function() {
      Reservation.Rates($(this));        
    });  
    $('#ratesperdayy').on('input', function() {
      Reservation.Rates($(this));        
    });  */ 

  /* $('#reservationForm').validate({
    rules: {
      checkin: {
        required: true,        
      },
      checkout: {
        required: true        
      },
      adults: {
        required: true,
        range: [1, 300],
        number: true       
      },
      fullname:{
        required: true,
        minlength: 4
      },      
      
    },
    messages: {
      checkin: {
        required: "This field is required"        
      },
      checkout: {
        required: "This field is required"        
      },
      adults: {
        required: "This field is required"        
      },
      fullname: {
        required: "This field is required"        
      }
      
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  }); */

    
      //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    $('#reservationcheckout').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

 
   
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

   
    //
    
  })
</script>
@endpush