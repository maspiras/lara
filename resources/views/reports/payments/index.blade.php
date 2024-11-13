@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-5">
            <h1 class="m-0">Reports</h1>
          </div><!-- /.col -->
          
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
              <li class="breadcrumb-item active">Reports</li>
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
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Payments</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">  
                  <div class="table-responsive">                  
                  {{ $dataTable->table(['width' => '100%', 'id'=>'payments-table', 'class' => 'table table-bordered table-hover dataTable'])}}
                  </div>  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->                
            </div><!-- /.Ccol -->     

        </div><!-- /.row -->        
      </div><!-- /.container-fluid -->      
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
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
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script src="{{ url('/') }}/plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">
  $(function () {
    'use strict'
    $('.treeview-reports').addClass('active');        
    $('.menu-open-reports').addClass('menu-open');
    $('.reports-guest-payments').addClass('active');    
    
});
</script>
@endpush