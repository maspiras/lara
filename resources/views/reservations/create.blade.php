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
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Checkin</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" id="checkin" name="checkin" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>                
              </div>
              <div class="form-group">
                <label for="inputName">Checkout</label>
                    <div class="input-group date" id="reservationcheckout" data-target-input="nearest">
                        <input type="text" id="checkout" name="checkout" class="form-control datetimepicker-input" data-target="#reservationcheckout"/>
                        <div class="input-group-append" data-target="#reservationcheckout" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>                
              </div>
              
              <div class="form-group">
                <label for="inputStatus">Adults</label>
                <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-user"></i></span>
                        </div>
                        <select id="inputStatus" name="adults" class="form-control custom-select">
                        <option selected>1</option>
                        @for ($a = 0; $a <= 300; $a++)
                        <option> {{ $a }}</option>
                        @endfor
                        </select>
                    </div>
              </div>
              <div class="form-group">
                    <label for="inputStatus">Childs</label>                
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-user"></i></span>
                        </div>
                        <select id="inputStatus" name="childs" class="form-control custom-select">
                        <option disabled>Select one</option>
                        @for ($c = 0; $c <= 100; $c++)
                        <option> {{ $c }}</option>
                        @endfor
                        </select>
                    </div>
              </div>
              <div class="form-group">
                <label for="inputStatus">Pets</label>
                <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-cat"></i></span>
                        </div>
                        <select id="inputStatus" name="pets" class="form-control custom-select">
                        <option disabled>Select one</option>
                        @for ($p = 0; $p <= 50; $p++)
                        <option> {{ $p }}</option>
                        @endfor
                        </select>
                    </div>
              </div>
              
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
          <div class="card card-primary collapsed-card">
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
                  Rooms List
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
                <label for="inputEstimatedBudget">Name</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputSpentBudget">Phone</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Phone">
                </div>

              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Email</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" placeholder="Email">
                </div>

              </div>
              
              <div class="form-group">
                <label for="inputDescription">Project Description</label>
                <textarea id="inputDescription" class="form-control" rows="4" placeholder="Additional information"></textarea>
              </div>

              <div class="form-group">
                  <label>Booking Source</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Other</option>
                    <option value="1">Phone</option>
                    <option>Facebook/Messenger/FB Page</option>
                    <option>Tiktok</option>
                    <option>Instagram</option>                    
                    <option>Email</option>
                    <option>Booking.com</option>
                    <option>Airbnb</option>
                    <option>Website</option>                    
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
                  <input type="text" class="form-control" placeholder="0.00">
                </div>
              </div>
              <div class="form-group">
                <label for="inputSpentBudget">Days stay</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-moon"></i></span>
                  </div>
                  <input type="text" disabled class="form-control" placeholder="1" name="daystay" id="daystay">
                </div>

              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Rates per stay</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input type="email" class="form-control" placeholder="0.00">
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
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">PHP</option>
                    <option value="1">PHP</option>
                    <option value="2">USD</option>
                    <option value="3">EUR</option>                    
                    <option value="3">CAD</option>
                    <option value="3">AUD</option>
                    <option value="3">GBP</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>Payment status</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">No payment</option>
                    <option value="1">Prepayment paid</option>
                    <option>Fully paid</option>                 
                  </select>
              </div>  

              <div class="form-group">
                  <label>Type of payment</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Select</option>
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
                  <input type="text" class="form-control" placeholder="0.00">
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
<script type="text/javascript" src="{{ url('/') }}/js/reservation.js"></script>
<script>
  $(function () {
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

    
  })
</script>
@endpush