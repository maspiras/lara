@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
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
      <div class="container-fluid">
      <div class="container">
  <main>
    <!-- <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
      <h2>Checkout form</h2>
      <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div> -->

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your bill</span>
          <span class="badge bg-primary rounded-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Rooms</h6>
              <small class="text-body-secondary">
              @foreach($myReservedRooms as $mrr)
                  {{$mrr}},
              @endforeach
              </small>
            </div>
            <span class="text-body-secondary">{{$myReservation->subtotal}}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Meal/s</h6>
              <small class="text-body-secondary">{{$myReservedMeals->meals_name}}</small>
            </div>
            <span class="text-body-secondary">{{$myReservation->meals_total}}</span>
          </li>
          @foreach($myReservedServices as $mrs)
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">{{$mrs->service_name}}</h6>
              
            </div>
            <span class="text-body-secondary">{{$mrs->amount}}</span>
          </li>
                  
          @endforeach
          
          <!-- <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
            <div class="text-success">
              <h6 class="my-0">Promo code</h6>
              <small>EXAMPLECODE</small>
            </div>
            <span class="text-success">−$5</span>
          </li> -->
          <li class="list-group-item d-flex justify-content-between">
            <span>Total ({{$myReservation->currency_code}})</span>
            <strong>{{ $myReservation->grandtotal }}</strong>
          </li>
        </ul>

        <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form>
      </div>
      <div class="col-md-7 col-lg-8">
        
      <form class="needs-validation" novalidate>  
          
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <h5>Reservation Details</h5>
                  <address>                    
                    <strong>Checkin:</strong> {{date('M d, Y', strtotime($myReservation->checkin))}}<br>
                    <strong>Checkout:</strong> {{date('M d, Y', strtotime($myReservation->checkout))}}<br>
                    <strong>Night/s of stay:</strong> @php
                    $now = strtotime($myReservation->checkout); // or your date as well
                    $your_date = strtotime($myReservation->checkin);
                    $datediff = $now - $your_date;
                    $diff = round($datediff / (60 * 60 * 24));
                    if($diff <= 0){
                      $diff = 0;
                    }
                    echo $diff;
                    @endphp<br>
                    <strong>Adult/s:</strong> {{$myReservation->adults}}<br>
                    <strong>Child/s:</strong> {{$myReservation->childs}}<br>
                    <strong>Pet/s:</strong> {{$myReservation->pets}}<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                <h5>Guest Information</h5>
                  <address>                    
                    <strong>Full name:</strong> {{$myReservation->fullname}}<br>
                    <strong>Phone:</strong> {{$myReservation->phone}}<br>
                    <strong>Email:</strong> {{$myReservation->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Reference No.</b>  {{$myReservation->ref_number}}
                  <br>
                  <b>Booking Date:</b> {{date('M d, Y', strtotime($myReservation->created_at))}}
                  
                </div>
                <!-- /.col -->
          <hr class="my-4">

          

          <h4 class="mb-3">Payment</h4>
          <div class="row gy-3">
            
            <div class="col-sm-3">
              <div class="form-check">
                <input id="cash" name="paymentMethod" type="radio" class="form-check-input" checked required>
                <label class="form-check-label" for="cash">Cash</label>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-check">
                <input id="obt" name="paymentMethod" type="radio" class="form-check-input">
                <label class="form-check-label" for="obt">Online Bank Transfer</label>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-check">
                <input id="credit" name="paymentMethod" type="radio" class="form-check-input">
                <label class="form-check-label" for="credit">Credit card</label>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-check">
                <input id="cheque" name="paymentMethod" type="radio" class="form-check-input">
                <label class="form-check-label" for="cheque">Cheque</label>
              </div>
            </div>  
            <!-- <div class="col-sm-3">
              <div class="form-check">
                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                <label class="form-check-label" for="debit">Debit card</label>
              </div>
              <div class="form-check">
                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                <label class="form-check-label" for="paypal">PayPal</label>
              </div>
            </div> -->
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Currency</label>              
              <select class="form-control select2" style="width: 100%;" id="currency" name="currency">
                <option selected value="{{ $myReservation->currency_id }}">{{$myReservation->currency_code}} - {{$myReservation->currency_country}}</option>
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

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Grand Total</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input disabled type="text" class="form-control" placeholder="0.00" value="{{ $myReservation->grandtotal }}" name="grandtotal" id="grandtotal">
                </div>
            </div>
            <div class="col-md-6">
              <label for="cc-number" class="form-label">Prepayment</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input disabled type="text" class="form-control" placeholder="0.00" value="{{ $myReservation->prepayment }}" name="prepayment" id="prepayment">
                </div>
            </div>
            <div class="col-md-6">
              <label for="cc-number" class="form-label">Balance to pay</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input type="hidden" class="form-control" value="{{ $myReservation->prepayment }}" name="paid" id="paid">
                  <input disabled type="text" class="form-control" placeholder="0.00" value="{{ $myReservation->balancepayment }}" name="balance" id="balance">
                </div>
            </div>

            <div class="col-md-12">
              <label for="cc-expiration" class="form-label">Additional payment</label>
              
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                  </div>
                  <input type="number" min="0" class="form-control" placeholder="0.00" value="0" id="prepayment" name="prepayment">
                </div>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Make payment</button>
        </form>
      </div>
    </div>
  </main>

  
</div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
<link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    .container {
  max-width: 960px;
}
.bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
</style>
@endpush
@push('scripts')
<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript">
// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')
  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
@endpush

        

