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
                        <!-- <a class="btn btn-success" href="{{ route('reservations.create') }}"><i class="fa fa-plus"></i> Create New Reservation</a>&nbsp;    -->                                             
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

    

   

          <!-- <div class="card card-info"> -->
          <div class="card card-info">
              <div class="card-header">
                
                @can('room-create')                        
                        <a class="btn btn-secondary" href="{{ route('reservations.create') }}"><i class="fa fa-plus"></i> Create New Reservation</a>&nbsp;                                                
                        @endcan
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div mbsc-page class="demo-month-view">
                  <div style="height:100%">
                          <div id="demo-month-view"></div>
                
                  </div>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
              
   

</div>
@endsection
@push('styles')  
  <link rel="stylesheet" href="{{ url('/') }}/css/mobiscroll.jquery.min.css">  
  <style>
    .mbsc-timeline-header-column,
    .mbsc-timeline-column {
      width: 3.8em;
    }
    .mbsc-timeline-resource-col {
  width: 80px;
}

/* For sticky event labels */
@supports (overflow: clip) {
  .mbsc-timeline.mbsc-ltr .mbsc-schedule-event-inner {
    left: 80px;
  }

  .mbsc-timeline.mbsc-rtl .mbsc-schedule-event-inner {
    right: 80px;
  }
}


  </style>
@endpush
@push('scripts')
<script>
   
   
    function function1() {      
      document.body.innerHTML = document.body.innerHTML.replace(/TRIAL/g, '');
    }

    function runner() {
        function1();
        setTimeout(function() {
            runner();
        }, 12000);
    }

    //runner();
    
</script>
<script src="js/mobiscroll.jquery.min.js"></script>
<script>
  //document.body.innerHTML = document.body.innerHTML.replace('Reservations', 'hi');
  $(function () {
   
    $('.treeview-calendar').addClass('active');
    //$('body').text().replace(/reservation/g,'nice')  
    //document.body.innerHTML = document.body.innerHTML.replace(/reservation/g,'nice');
    


            
  });
  
 
</script>
<script>
        
            mobiscroll.setOptions({
      locale: mobiscroll.localeEn,  // Specify language like: locale: mobiscroll.localePl or omit setting to use default
      theme: 'ios',                 // Specify theme like: theme: 'ios' or omit setting to use default
            themeVariant: 'light',   // More info about themeVariant: https://mobiscroll.com/docs/jquery/eventcalendar/api#opt-themeVariant
            virtualScroll: false
    });
    
    $(function () {
      $('#demo-month-view')
        .mobiscroll()
        .eventcalendar({
          // drag,
          view: {                   // More info about view: https://mobiscroll.com/docs/jquery/eventcalendar/api#opt-view
            timeline: {
              
              type: 'month',
            },
          },
          data: [                   // More info about data: https://mobiscroll.com/docs/jquery/eventcalendar/api#opt-data
            @php
            $bookedrooms = '';
            $color = '#e20000';
            
                foreach($reservedrooms as $rr){
                  if ($rr->prepayment > 0) {
                      $color = '#1dab2f';            
                      if($rr->prepayment == $rr->grandtotal){
                        $color = '#d6d145';
                      }
                    
                  }
                    
                  
                    $bookedrooms .= "{
                      start: '".$rr->checkin."',
                      end: '".$rr->checkout."',
                      title: '".$rr->fullname."',
                      color: '".$color."',
                      resource: ".$rr->room_id.",
                    },";
                    $color = '#e20000';
                }
            @endphp
            {!! $bookedrooms !!}
          ],
          resources: [              // More info about resources: https://mobiscroll.com/docs/jquery/eventcalendar/api#opt-resources
            @php
            $showrooms = '';
                foreach($rooms as $r){
                    $showrooms .= "{
                      id: ".$r->id.",
                      name: '".$r->room_name."'
                    },";
                }
            @endphp
                {!! $showrooms !!}
          ],
        });
    });

    document.body.innerHTML = document.body.innerHTML.replace(/TRIAL/g, '');
    </script>
@endpush

        

