<form method="post" id="serviceForm" action="{{ route('services.store') }}">
@csrf    
<div class="modal addservicesmodal fade" id="addservicesmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Services</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="card card-primary">    
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="servicessavestatus">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12  col-12">
                                <div class="form-group row">
                                    <p for="servicename" class="col-lg-3">Name</p>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control col" id="servicename" name="servicename" placeholder="" required>
                                    </div>
                                </div>
                            </div> <!-- /.col-lg -->
                            <div class="col-lg-12 col-12">
                                <div class="form-group row">
                                    <p for="servicedesc" class="col-lg-3">Description</p>
                                    <div class="col-lg-9">                                        
                                        <textarea id="servicedesc" name="servicedesc"  class="form-control"  placeholder=""></textarea>
                                    </div>
                                </div>
                            </div> <!-- /.col-lg -->
                            <div class="col-lg-12 col-12">
                                <div class="form-group row">
                                    <p for="serviceperiod" class="col-lg-3">Period</p>
                                    <div class="col-lg-9">                                        
                                        <select class="form-control" id="serviceperiod" name="serviceperiod">
                                            <option value="1">Per night</option>
                                            <option value="2">For the stay</option>                               
                                        </select>
                                    </div>
                                </div>
                            </div> <!-- /.col-lg -->
                            <div class="col-lg-12 col-12">
                                <div class="form-group row">
                                    <p for="servicepayment" class="col-lg-3">Payment</p>
                                    <div class="col-lg-9">                                        
                                        <select class="form-control" id="servicepayment" name="servicepayment">
                                            <option value="1">Per person</option>
                                            <option value="2">For the service</option>                               
                                        </select>
                                    </div>
                                </div>
                            </div> <!-- /.col-lg -->
                            <div class="col-lg-12 col-12">
                                <div class="form-group row">
                                    <p for="serviceprice" class="col-lg-3">Price</p>
                                    <div class="col-lg-9">                                        
                                        <div class="input-group mb-3">                
                                            <div class="input-group-prepend">                    
                                                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                                            </div>
                                            <input type="number" class="form-control" id="serviceprice"  min="0" name="serviceprice" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.col-lg -->
                        </div><!-- /.row -->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" id="host_id" name="host_id" value="{{auth()->user()->host_id}}">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btnservicesave">Save changes</button>
            </div>
          </div><!-- /.modal-content -->        
  </div>
</div>
</form>