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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          {{ $dataTable->table(['class' => 'table table-bordered reservations table-hover', 'width' => "100%"]) }}              
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
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

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
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


    /* $("#example1").DataTable({
      //scrollX: 400,
      scrollX: true,
      "ordering": false,
      paging: false, 
      "responsive": false, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

      

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
 */
    

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

<script type="text/javascript">
    /* $(function () {
          var table = $('#example1').DataTable({
              "responsive": false, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
              processing: true,
              serverSide: true,
              ajax: "{{ route('reservations.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'fullname', name: 'fullname'},
                  {data: 'checkin', name: 'checkin'},
                  {data: 'checkout', name: 'checkout'},
                  {data: 'booking_status_id', name: 'user_id'},
              ],
              scrollX: true,
              "ordering": true,
              paging: true, 
              "responsive": false, "lengthChange": true, "autoWidth": false,
              
          });
        }); */
</script>

@endpush

        

