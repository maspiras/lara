@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rooms</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Rooms</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            
                <div class="col-lg-12 margin-tb">
                    
                    <div class="pull-right">
                    
                        @can('room-create')
                        <a class="btn btn-success btn-sm mb-2" href="{{ route('rooms.create') }}"><i class="fa fa-plus"></i> Create New Room</a>
                        @endcan
                    </div>
                </div>
            </div>


            @session('success')
                <div class="alert alert-success" role="alert"> 
                    {{ $value }}
                </div>
            @endsession
           
            


            <!-- /.row -->
            <div class="album py-5 bg-body-tertiary">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12 margin-tb">
                    {!! $products->links() !!}
                  </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">                
                  @foreach ($products as $product)
                  <div class="col">
                    <div class="card shadow-sm">
                      <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$product->room_name}}</text></svg>
                      <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                          <a class="btn btn-info btn-sm" href="{{ route('rooms.show',$product->id) }}"><i class="fa-solid fa fa-list"></i> Show</a>
                            @can('room-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('rooms.edit',$product->id) }}"><i class="fa-solid fa fa-pen"></i> Edit</a>
                            <a class="btn btn-danger btn-sm" href="{{ route('rooms.destroy',$product->id) }}"><i class="fa-solid fa fa-trash"></i> Delist</a>
                            @endcan
                          </div>
                          <small class="text-body-secondary">9 mins</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            
            
        </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('scripts')
<script>
  $(function () {    
    
  });
</script>
@endpush