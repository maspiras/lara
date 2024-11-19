<!-- Modal -->
<div class="modal servicesmodal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Additional services</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-primary">    
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="serviceslist">
                        <div class="row">
                    @foreach($services as $service => $v )   
                    <div class="col-xs-6 col-sm-6 col-lg-6 col-6">
                        <div class="form-group clearfix">
                        <div class="icheck-success d-inline">
                            <input type="checkbox" id="services{{$v['id']}}" name="services[]" class="rooms" value="{{$v['id'].'/'.$v['period'].'/'.$v['payment'].'/'.$v['amount']}}" title="{{$v['service_name']}}">
                            <label for="services{{$v['id']}}">
                                    {{$v['service_name']}}
                            </label>
                        </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                    </div>

                    <!-- <div class="col-xs-6 col-sm-6 col-lg-6 col-6">
                        
                        <div class="form-group clearfix">
                        <div class="icheck-success d-inline">
                            <input type="checkbox" id="services2" name="services[]" class="rooms" value="2" title="Pay Parking">
                            <label for="services2">
                                    Pay Parking
                            </label>
                        </div>
                        </div>
                    </div> -->

                </div><!-- /.row -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->
            
      </div>
      <div class="modal-footer ">
            <a class="btn btn-primary addnewservices float:left" href="#"><i class="fa-solid fa"></i>ADD NEW</a>             
            <button type="button" class="btn btn-secondary float:right" data-dismiss="modal">CANCEL</button>
            <button type="button" class="btn btn-success  float:right btn-services-okay">OKAY</button> 
      </div>
    </div>
  </div>
</div>


<div class="card card-primary collapsed-card servicescard">
<!-- <div class="card card-primary servicescard"> -->
    <div class="card-header">
        <h3 class="card-title">Additional Services</h3>
        <div class="card-tools">            
            <!-- <button type="button" class="btn btn-tool btn-services" data-card-widget="collapse"><i class="fas fa-plus"></i> -->
            <button type="button" class="btn btn-tool btn-services"><i class="fas fa-plus"></i>
            </button>
        </div>
    <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">        
        <div class="row">
            <div class="col-lg">
                <!-- <div class="card">
                    <div class="card-body"> -->
                        <hr class="hr" />
                    <div class="serviceschosen">
                        
                        <!-- <div class="service">
                            <div class="form-group row">
                                <p for="inputEmail3" class="col-lg-7 col-md-7 col-7 col-form-label">Foot Massage</p>
                                <div class="col-lg-4 col-md-4 col-4">
                                    <input type="number" class="form-control col servicesamount" id="services-1" name="servicesamount[]" placeholder="0.00">
                                </div>
                                <div class="col-lg-1 col-md-1 col-1">
                                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </div>                                
                            </div>
                            <div class="form-group row">
                                <p for="inputPassword3" class="col-lg-7 col-7 col-form-label">Status</p>
                                <div class="col-lg-5 col-5">
                                    <select class="form-control" id="services-status1" name="services-status[]">
                                    <option value="0">No payment</option>
                                    <option value="1">Paid</option>                               
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="service">
                            <div class="form-group row">
                                <p for="inputEmail3" class="col-lg-7 col-md-7 col-7 col-form-label">Foot Massage</p>
                                <div class="col-lg-4 col-md-4 col-4">
                                    <input type="number" class="form-control col  servicesamount" id="services-2" name="servicesamount[]" placeholder="0.00">
                                </div>
                                <div class="col-lg-1 col-md-1 col-1">
                                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <p for="inputPassword3" class="col-lg-7 col-7 col-form-label">Status</p>
                                <div class="col-lg-5 col-5">
                                    <select class="form-control" id="services-status2" name="services-status[]">
                                    <option value="0">No payment</option>
                                    <option value="1">Paid</option>                               
                                    </select>
                                </div>
                            </div>
                        </div> -->
                    </div> <!-- div /.services chosen -->
                        
                        <div class="form-group row">
                            <input type="hidden" id="servicestotalamount" name="servicestotalamount" value="0">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Amount</label>
                            <div class="col-sm-8">                                
                                <h2 class="text-right servicestotalamount">0.00</h2>                                
                            </div>
                        </div>
                    
                    <!-- </div>
                </div> -->

            </div><!-- /.col -->       
        </div><!-- /.row -->        
    </div><!-- /.card-body -->
<!-- <div class="overlay">
  <i class="fas fa-2x fa-sync-alt fa-spin"></i>
</div>     -->
</div><!-- /.card -->