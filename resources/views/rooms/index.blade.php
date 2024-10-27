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
            {!! $products->links() !!}
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->room_name }}</td>
                    <td>&nbsp;</td>
                    <td>
                        <form action="{{ route('rooms.destroy',$product->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('rooms.show',$product->id) }}"><i class="fa-solid fa fa-list"></i> Show</a>
                            @can('room-edit')
                            <a class="btn btn-primary btn-sm" href="{{ route('rooms.edit',$product->id) }}"><i class="fa-solid fa fa-pen"></i> Edit</a>
                            @endcan

                            @csrf
                            @method('DELETE')

                            @can('room-delete')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa fa-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>

{!! $products->links() !!}
            <!-- /.row -->
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
    /* For Active Menu */
    $('.treeview-rooms').addClass('active');
  });
</script>
@endpush