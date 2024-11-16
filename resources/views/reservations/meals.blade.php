<!-- Modal -->
<div class="modal mealsmodal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Meals for the whole stay</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-primary">    
            <!-- /.card-header -->
            <div class="card-body">        
                <div class="row">   
                    
                <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                    
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals1" name="meals[]" checked>
                        <label for="meals1"> Without Meals</label>
                      </div>                      
                </div>
            </div>
            <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals2" name="meals[]" class="meals" value="">
                        <label for="meals2">
                        Breakfast
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals3" name="meals[]" class="meals" value="">
                        <label for="meals3">
                        Lunch
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals4" name="meals[]" class="meals" value="">
                        <label for="meals4">
                        Dinner
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals5" name="meals[]" class="meals" value="">
                        <label for="meals5">
                        Breakfast, Lunch
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals6" name="meals[]" class="meals" value="">
                        <label for="meals6">
                        Lunch, Dinner
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals7" name="meals[]" class="meals" value="">
                        <label for="meals7">
                        Breakfast, Dinner
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals8" name="meals[]" class="meals" value="">
                        <label for="meals8">
                        All inclusive (Breakfast, Lunch & Dinner)
                        </label>
                    </div>
                </div>
            </div>



                </div><!-- /.row -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        <button type="button" class="btn btn-primary btn-meals-okay">OKAY</button>
      </div>
    </div>
  </div>
</div>

<div class="card card-primary collapsed-card mealscard">
<!-- <div class="card card-primary mealscard"> -->
    <div class="card-header">
        <h3 class="card-title">Meal/s</h3>
        <div class="card-tools">
            <!-- <button type="button" class="btn btn-tool btn-meals" data-card-widget="collapse"><i class="fas fa-plus"></i> -->
            <button type="button" class="btn btn-tool btn-meals"><i class="fas fa-plus"></i>
            </button>
        </div>
    <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">        
        <div class="row">
            <div class="col-lg">
                <div class="input-group mb-3">                
                    <div class="input-group-prepend">                    
                        <span class="input-group-text"><i class="far fa-user"></i></span>
                    </div>
                    <input type="number" class="form-control" id="mealsadults"  min="0" max="300" name="mealsadults" placeholder="Adults">
                </div>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-lg">
                <div class="input-group mb-3">                
                    <div class="input-group-prepend">                    
                        <span class="input-group-text"><i class="fa fa-child"></i></span>                        
                    </div>
                    <input type="number" class="form-control" id="mealschilds" min="0" max="300" name="mealschilds" placeholder="Childs">
                </div>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-lg">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Amount</label>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">                
                            <div class="input-group-prepend">                    
                                <span class="input-group-text"><i class="fa fa-money-bill"></i></span>
                            </div>
                            <input type="number" class="form-control" id="mealsamount"  min="0" name="mealsamount" placeholder="0.00">
                        </div>
                    </div>
                </div>
                
            </div>
        </div><!-- /.row -->
    </div><!-- /.card-body -->
<!-- <div class="overlay">
  <i class="fas fa-2x fa-sync-alt fa-spin"></i>
</div>     -->
</div><!-- /.card -->