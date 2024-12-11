<div class="col col-sm-12">
<div class="card">
    <div class="card-header">
    <strong>Recent Reservations</strong>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <div class=" table-responsive">
    <table id="recent_transaction" class="table table-bordered table-striped">
        <thead>
        <tr><th>Ref #</th><th>Name</th><th>Checkin</th><th>Checkout</th><th>Status</th><th>Action</th></tr>
        </thead>
        <tbody>
        @foreach($recentreservation as $r)
        @php   
            
            if($r->payment_status == 1){
                $ps = 'No payment' ;
                $cl = 'table-danger';
            }elseif($r->payment_status == 2){
                $ps = 'Partial' ;
                $cl = 'table-success';
            }elseif($r->payment_status == 3){
                $ps = 'Fully Paid'; 
                $cl = 'table-warning';
            }else{
                $ps = 'Refunded';
            }
        
        @endphp
        <tr class="{{$cl}}"><td>{{$r->ref_number}}</td><td>{{$r->fullname}}</td><td>{{date('M d, Y H:i a', strtotime($r->checkin))}}</td><td>{{date('M d, Y H:i a', strtotime($r->checkout))}}</td>
        <td>{{$ps}}</td>
            <td class="text-center">
            <div class='btn-group'>
    
    <a href="{{ route('reservations.edit', $r->reservation_id) }}" class='btn btn-success editreservation'>
        <i class="fa-solid fa fa-pen"></i> edit
    </a>
    <a href="{{ route('reservations.show', $r->reservation_id) }}" class='btn btn-primary showreservation'>
        <i class="fa fa-list"></i> show
    </a>
    
</div>
            </td>
            </td>
        </tr>         
        @endforeach         
        </tbody>
        <tfoot>
        <tr><th>Ref #</th><th>Name</th><th>Checkin</th><th>Checkout</th><th>Status</th><th>Action</th></tr>
        </tfoot>
    </table>
    </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>