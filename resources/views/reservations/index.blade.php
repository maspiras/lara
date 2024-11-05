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
    <!-- <div class="content">
        <div class="container-fluid">
            <div class="row">            
                <div class="col-lg-12 margin-tb">                
                    <div class="pull-right">
                        @can('room-create')                        
                        <a class="btn btn-success" href="{{ route('reservations.create') }}"><i class="fa fa-plus"></i> Create New Reservation</a>&nbsp;                                                
                        @endcan
                    </div>    
                </div>
            </div>
        </div>
    </div> --> <!-- end main content -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          
              <div mbsc-page class="demo-month-view">
                  <div style="height:100%">
                          <div id="demo-month-view"></div>
                
                  </div>
              </div>
                
              
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->



</div>
@endsection
@push('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/css/mobiscroll.jquery.min.css">
  <style>

    /* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
 
    div.container {
        width: 80%;
    }
  </style>
@endpush
@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ url('/') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ url('/') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ url('/') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ url('/') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ url('/') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/reservation.js"></script>
<script src="js/mobiscroll.jquery.min.js"></script>

<script>
  $(function () {
    /*$("#example1").DataTable({
      //scrollX: 400,
      scrollX: true,
      "ordering": false,
      //columnDefs: [{ width: 200, targets: 0 }],
      columnDefs: [{ width: '20%', targets: 0 }],
    fixedColumns: true,
    paging: false,
    scrollCollapse: true,
    
      "responsive": false, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    */

    $("#example1").DataTable({
      //scrollX: 400,
      scrollX: true,
      "ordering": false,
      paging: false, /* set to true will show entries and pagination*/
      "responsive": false, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

     /* new DataTable('#example1', {
        columnDefs: [{ width: '50%', targets: 0 }],
        fixedColumns: true,
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        "ordering": false,
        //scrollY: 300
    }); */
    
  });
</script>
<script>
        
            mobiscroll.setOptions({
      locale: mobiscroll.localeEn,  // Specify language like: locale: mobiscroll.localePl or omit setting to use default
      theme: 'ios',                 // Specify theme like: theme: 'ios' or omit setting to use default
            themeVariant: 'light'   // More info about themeVariant: https://mobiscroll.com/docs/jquery/eventcalendar/api#opt-themeVariant
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
                  if (!empty($rr->prepayment)) {
                    $color = '#1dab2f';
                  }else{
                    $color = '#e20000';
                  }
                    $bookedrooms .= "{
                      start: '".$rr->checkin."',
                      end: '".$rr->checkout."',
                      title: '".$rr->fullname."',
                      color: '".$color."',
                      resource: ".$rr->room_id.",
                    },";
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
      
    </script>
<!-- <script type="text/javascript" class="init">

				

new DataTable('#example1', {
	columnDefs: [{ width: '20%', targets: 0 }],
	fixedColumns: true,
	paging: false,
	scrollCollapse: true,
	scrollX: true,
	scrollY: 300,
  "autoWidth": false,
});


		
	</script> -->
@endpush

        

