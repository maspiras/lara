<!-- Modal -->
<div class="modal refundmodal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Refund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="refundForm" action="{{ route('reservation.refund', $reservation->id) }}">
            @csrf
            @method('patch')
            <div class="modal-body">
                <div class="card card-primary">    
                    <!-- /.card-header -->
                    <div class="card-body">        
                        <div class="row">  
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="refund">Amount to refund:</label>
                                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                    </div>
                                    <input type="hidden" name="currency_id" value="{{$reservation->currency_id }}">
                                    
                                    <input type="number" class="form-control" placeholder="0.00" value="0" id="refund" name="refund" >
                                    </div>
                                </div>
                            </div>                            
                        </div><!-- /.row -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>
            </form>
        </div>
    </div>
</div>