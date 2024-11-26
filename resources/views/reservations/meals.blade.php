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
                        <div class="form-group clearfix">                            
                            <div class="icheck-success d-inline">
                            @if(isset($myReservedMeals->reservation_id))
                                @if($myReservedMeals->reservation_id == 0 || $myReservedMeals->reservation_id = '')
                                <input type="radio" id="meals0" name="meals" checked value="">
                                @else
                                <input type="radio" id="meals0" name="meals" value="">    
                                @endif
                            @else
                                <input type="radio" id="meals0" name="meals" value="">
                            @endif
                                <label for="meals0"> Without Meals</label>
                            </div>                      
                        </div>
                    </div>                     
                    
                    @foreach($meals as $meal)
                    <div class="col-sm-6">
                        <div class="form-group clearfix">
                            <div class="icheck-success d-inline">
                                @if(isset($myReservedMeals->reservation_id))
                                <input type="radio" id="meals{{$loop->index+1}}" name="meals" class="meals"{{ $myReservedMeals->meal_id == $meal->id ? 'checked' : '' }}  value="{{$meal->id}}">
                                @else
                                <input type="radio" id="meals{{$loop->index+1}}" name="meals" class="meals"  value="{{$meal->id}}">    
                                @endif
                                <label for="meals{{$loop->index+1}}">
                                {{$meal->meals_name}}
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
            <!-- <div class="col-sm-6">
                
                <div class="form-group clearfix">
                    
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals1" name="meals" checked value="">
                        <label for="meals1"> Without Meals</label>
                      </div>                      
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals2" name="meals" class="meals" value="1">
                        <label for="meals2">
                        Breakfast
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals3" name="meals" class="meals" value="2">
                        <label for="meals3">
                        Lunch
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals4" name="meals" class="meals" value="3">
                        <label for="meals4">
                        Dinner
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals5" name="meals" class="meals" value="4">
                        <label for="meals5">
                        Breakfast, Lunch
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals6" name="meals" class="meals" value="5">
                        <label for="meals6">
                        Lunch, Dinner
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals7" name="meals" class="meals" value="6">
                        <label for="meals7">
                        Breakfast, Dinner
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" id="meals8" name="meals" class="meals" value="7">
                        <label for="meals8">
                        All inclusive (Breakfast, Lunch & Dinner)
                        </label>
                    </div>
                </div>
            </div> -->



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


@if(isset($myReservedMeals->reservation_id))
<div class="card card-primary mealscard">
@else
<div class="card card-primary collapsed-card mealscard">
@endif
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
                    @if(isset($myReservedMeals->meal_adults))
                    <input type="number" class="form-control" id="mealsadults"  min="0" max="300" name="mealsadults" placeholder="Adults" value="{{$myReservedMeals->meal_adults}}">
                    @else
                    <input type="number" class="form-control" id="mealsadults"  min="0" max="300" name="mealsadults" placeholder="Adults" >
                    @endif
                </div>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-lg">
                <div class="input-group mb-3">                
                    <div class="input-group-prepend">                    
                        <span class="input-group-text"><i class="fa fa-child"></i></span>                        
                    </div>
                    @if(isset($myReservedMeals->meal_childs))
                    <input type="number" class="form-control" id="mealschilds" min="0" max="300" name="mealschilds" placeholder="Childs" value="{{$myReservedMeals->meal_childs}}">
                    @else
                    <input type="number" class="form-control" id="mealschilds" min="0" max="300" name="mealschilds" placeholder="Childs" >
                    @endif
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
                            @if(isset($myReservedMeals->amount))
                            <input type="number" class="form-control" id="mealsamount"  min="0" name="mealsamount" placeholder="0.00" value="{{$myReservedMeals->amount}}">
                            @else
                            <input type="number" class="form-control" id="mealsamount"  min="0" name="mealsamount" placeholder="0.00">
                            @endif
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