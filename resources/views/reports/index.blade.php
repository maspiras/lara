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
            
            <div class="col-lg-6">
                <div class="card">
                  
                </div>
                <!-- /.card -->

            </div><!-- /.Ccol -->    
            <div class="col-lg-6">
                <div class="card">
                  
                </div>
                <!-- /.card -->

            </div><!-- /.Ccol -->     
        </div><!-- /.row -->        
      </div><!-- /.container-fluid -->      
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
@push('styles')  
  
@endpush
@push('scripts')
<script src="{{ url('/') }}/plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">
  $(function () {
    'use strict'
    $('.treeview-reports').addClass('active');        

});
</script>
@endpush