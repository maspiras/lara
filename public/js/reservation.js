$(document).ready(function(){    
    /* For Active Menu */
    $('.treeview-reservations').addClass('active'); 

    var Reservation = {
        DayStay: function(checkin, checkout){
            var diff = 0;
            /* checkin = $('#checkin').val();
            checkout = $('#checkout').val(); */
            if(checkin != '' && checkout != ''){
              var d1 = new Date(checkin);   
              var d2 = new Date(checkout);       
              diff = ( d2.getTime() - d1.getTime() ) / (1000 * 60 * 60 * 24);              
              //$('#daystay').val(diff);              
            }
            //alert(checkin +' x ' + checkout);
            
            return diff;
          //e.preventDefault();
        },
        RatesPerDay: function(frm, e){        
          //$('#ratesperday').val($('#ratesperstay').val() / $('#daystay').val());
           //ratesperstay = $('#ratesperstay').val() / $('#daystay').val();
         // var val = $( "input[name='daystay']" ).val();

         var ratesperstay = (Math.round($('#ratesperstay').val() / $('#daystay').val() * 100) / 100).toFixed(2);
         return parseFloat(ratesperstay);

         //alert($('#ratesperstay').val());
            
        },
        ShowRatesPerDay: function(){
            rate = Reservation.RatesPerDay();
           // alert(rate);
            if($('#daystay').val() == 0){
                $('#ratesperday').val($('#ratesperstay').val());
            }else{
                //(Math.round(num * 100) / 100).toFixed(2)
                //$('#ratesperstay').val($('#ratesperday').val() * $('#daystay').val());          
                $('#ratesperday').val(rate);
                $('#balance').val(rate);
            }
        },
        RatesPerStay: function(frm, e){        
            var rates = (Math.round($('#ratesperday').val() * $('#daystay').val() * 100) / 100).toFixed(2);
            return parseFloat(rates);          
          
        },
        ShowRatesPerStay: function(){
            rates = Reservation.RatesPerStay(); //replaced
            if($('#daystay').val() == 0){
                $('#ratesperstay').val($('#ratesperday').val());
            }else{
            //(Math.round(num * 100) / 100).toFixed(2)
            //$('#ratesperstay').val($('#ratesperday').val() * $('#daystay').val());          
            $('#ratesperstay').val(rates);
            $('#balance').val(rates);
            }
        },
        GetBalance: function(){
            grandtotal = Reservation.GetGrandTotal().replace(',','');  
            prepayment = parseFloat($('#prepayment').val());
            var balance = parseFloat(grandtotal) - prepayment
          
            if(grandtotal > prepayment){
                $('#balance').val(CommonLib.MoneyFormat(balance));            
            }else{
                $('#balance').val(0);
            }
        },
     
        GetServicesTotal: function(){
            var amount = 0;
            var services_added = 0;
            $('.serviceschosen .service .servicesamount').each(function(i){
                services_added++;
                serviceamount = $(this).val() == '' ? 0 : $(this).val().replace(',', "");
                amount = amount + parseFloat(serviceamount);
            });
            if(services_added == 0){
                Reservation.RemoveServicesCard();
            }
            return parseFloat(amount);
        },
        ShowAdditionalServices: function (){
            var checkboxes = $('input[name="services[]"]:checked');        
            if(checkboxes.length > 0){
                $('.serviceschosen').children().remove();            
                $('.servicestotalamount').text('0.00');
                $('#servicestotalamount').val(0);
                diff = Reservation.DayStay();
                checkboxes.each(function(i){
                    const service = $(this).val().split("/");                
                    id = service[0];
                    period = service[1];
                    payment = service[2];
                    amount = parseFloat(service[3]);
                    total = 0;
                    pax = parseInt($('#adults').val()) + parseInt($('#childs').val());
                    
                    if(period == 1){
                        total = amount * diff; 
                    }else{
                        total = amount;
                    }

                    if(payment == 1){
                        total = total * pax;
                    }else{
                        total = total;
                    }
                    
                    $('.serviceschosen').prepend('<div class="service"><div class="form-group row"><p for="serviceamount'+i+'" class="col-lg-7 col-md-7 col-7 col-form-label">'+$(this).prop('title')+'</p><div class="col-lg-4 col-md-4 col-4"><input type="hidden" id="service_id'+i+'" name="service_id[]" value="'+id+'"><input type="number" class="form-control col servicesamount" id="serviceamount'+i+'" name="servicesamount[]" value="'+ total +'" placeholder="0.00"></div><div class="col-lg-1 col-md-1 col-1"><a href="'+config.SitePath+'/services/'+id+'" class="btn btn-danger services_delete"><i class="fa fa-trash"></i></a></div></div><div class="form-group row"><p for="servicestatus'+i+'" class="col-lg-7 col-7 col-form-label">Status</p><div class="col-lg-5 col-5"><select class="form-control" id="services-status'+i+'" name="servicepaymentstatus[]"><option value="0">No payment</option><option value="1">Paid</option></select></div></div><hr class="hr" /></div>');
                }); 
                servicestotalamount =  CommonLib.MoneyFormat(Reservation.GetServicesTotal());              
                $('.servicestotalamount').text(servicestotalamount);
                $('#servicestotalamount').val(servicestotalamount);
                $('.servicescard').CardWidget('expand');            
            }else{
                Reservation.RemoveServicesCard();
            }
        },
        RemoveService: function(input){
            input.remove();            
        },
        RemoveServicesCard: function(){
            $('.servicestotalamount').text('0.00');
            $('#servicestotalamount').val(0);
            $('.serviceschosen').children().remove();
            $('.servicescard').CardWidget('collapse');
            
        },
        GetGrandTotal: function(){   
            mealsamount = $('#mealsamount').val();
            if(mealsamount.length > 0){
                mealsamount = parseFloat(mealsamount);
            }else{
                mealsamount = 0;
            }         
            grandtotal = Reservation.GetServicesTotal() + Reservation.RatesPerStay() + mealsamount;
            return CommonLib.MoneyFormat(grandtotal);
            //$('#grandtotal').val();
           
        },
        ShowGrandTotal: function(){
            $('#grandtotal').val(Reservation.GetGrandTotal());
        },
        DateRangePicker: function(input, checkin){
            input.daterangepicker({
              singleDatePicker: true,
              autoApply: true,
              minDate: checkin
            }, function(checkout, end1, label1) {                
                /* Reservation.DayStay($('#checkin').val(), moment(checkout).format('MM/DD/YYYY') );
                Reservation.RatesPerDay();  */
                $('#daystay').val(Reservation.DayStay($('#checkin').val(), moment(checkout).format('MM/DD/YYYY') ));
                Reservation.ShowRatesPerStay(); //replaced
                Reservation.ShowAdditionalServices();
                Reservation.ShowGrandTotal();
                Reservation.GetBalance();
              }
            );
        }

    } /* End of class Reservation */

    var Services = {

        Save: function(frm, e){
            var formData = $( frm ).serialize();
            var saving = AjaxLib.postAjaxData( config.SitePath + '/services', formData );
            saving.done(function(data){  
                if(data.status ==1){
                    $('.servicessavestatus').removeClass('alert-danger alert');
                    $('.servicessavestatus').addClass('alert-success alert');
                    $('.servicessavestatus').text(data.msg);
                    $("#serviceForm")[0].reset();                    
                    $('.servicesmodal').modal('show');
                    $('.addservicesmodal').modal('hide');

                }else{
                    $('.servicessavestatus').removeClass('alert-success alert');
                    $('.servicessavestatus').addClass('alert-danger alert');
                    $('.servicessavestatus').text(data.msg);
                }                             
                Services.getList($('#host_id').val());
            });
            saving.fail(function(jqXHR, textStatus, errorThrown) {             
                $('.servicessavestatus').removeClass('alert-danger alert');   	                
                $('.servicessavestatus').addClass('alert-success alert');
                $('.servicessavestatus').text(data.msg + ' '+textStatus + ': ' + errorThrown);
            });
            e.preventDefault();
        },

        getList: function(host_id){
            var getData = AjaxLib.getAjaxDataJson(config.SitePath + '/api/services?host_id=' + host_id);
            getData.done(function(data){                                
                datalength = data.length;
                if(datalength > 0){
                    $('.serviceslist .row').children().remove(); 
                    for (var i=0; i<datalength; i++) {
                        $('.serviceslist .row').append('<div class="col-xs-6 col-sm-6 col-lg-6 col-6">'+
                        '<div class="form-group clearfix">'+
                        '<div class="icheck-success d-inline">'+
                            '<input type="checkbox" id="services'+data[i]['id']+'" name="services[]" class="rooms" value="'+data[i]['id']+'/'+data[i]['period']+'/'+data[i]['payment']+'/'+data[i]['amount']+'" title="'+data[i]['service_name']+'">'+
                            '<label for="services'+data[i]['id']+'">' +
                            data[i]['service_name']+
                            '</label>'+
                        '</div>'+
                        '</div>'+
                    '</div>');                  
                        //alert(data[i]['service_name']);
                    }
                } 

            });    
            getData.fail(function(jqXHR, textStatus, errorThrown) {
                //console.log(textStatus + ': ' + errorThrown);
                toastr.error('<h5>'+textStatus + ': ' + errorThrown+'</h5>'); 
            });
        }

    };

    $('.btnservicesave').on( "click", function(e) {
        Services.Save($('#serviceForm'), e)
        e.preventDefault();   
    });
    $('#serviceForm').submit(function(e){
        Services.Save($('#serviceForm'), e)
        e.preventDefault();   
    });
    
    
    $( ".btn-meals" ).on( "click", function(e) {       
        //$('.mealscard').CardWidget('toggle');
        $('.mealsmodal').modal('show');
        e.preventDefault();
      } );

    $( ".btn-meals-okay" ).on( "click", function(e) {       
        $('.mealsmodal').modal('hide');
        if($('#meals1').is(':checked')) { 
            $('.mealscard').CardWidget('collapse');
            $('#mealsadults').val('');
            $('#mealsadults').attr("placeholder", "Adults");
            $('#mealschilds').val('');
            $('#mealschilds').attr("placeholder", "Childs");
            $('#mealsamount').val('');
            $('#mealsamount').attr("placeholder", "0.00");
        }else{
            $('.mealscard').CardWidget('expand');   
            
        }
        e.preventDefault();
    } );  
    
    $( ".btn-services" ).on( "click", function(e) {               
        $('.servicesmodal').modal('show');        
        e.preventDefault();
    } );

    /* add or remove services chosen entirely */
    $( ".btn-services-okay" ).on( "click", function(e) {      
        Reservation.ShowAdditionalServices();
        Reservation.ShowGrandTotal();
        Reservation.GetBalance();
        //alert(Reservation.RatesPerStay());
        //alert(Reservation.GetServicesTotal());
        $('.servicesmodal').modal('hide');
        
        e.preventDefault();
    } );

    $('.addnewservices').on('click', function(e){
        $('.servicesmodal').modal('hide');
        $('.addservicesmodal').modal('show');
        e.preventDefault();
    });

    $('.addservicesmodal').on('hidden.bs.modal', function () {
        $('.servicesmodal').modal('show');
    });


    $('.serviceschosen').on('input', '.servicesamount', function(e) {               
        servicestotalamount = Reservation.GetServicesTotal();
        $('.servicestotalamount').text(servicestotalamount);
        $('#servicestotalamount').val(servicestotalamount);
        Reservation.ShowGrandTotal();
        Reservation.GetBalance();
        e.preventDefault();
    });

    /* Delete services to services chosen */
    $('.serviceschosen').on('click', '.services_delete', function(e) {          
        
        service_url= $(this).attr('href').split('/');
        service_id = service_url[service_url.length-1];
        
        $('#services' + service_id).prop('checked', false); 

        Reservation.RemoveService($(this).closest('.service'));
        servicestotalamount = Reservation.GetServicesTotal();
        $('.servicestotalamount').text(servicestotalamount);
        $('#servicestotalamount').val(servicestotalamount);
        Reservation.ShowGrandTotal();
        Reservation.GetBalance();
        //alert(Reservation.GetServicesTotal());
        e.preventDefault();
    });
    

    
    $('#ratesperday').on('input', function() {        
        if($(this).val().length > 0){
            Reservation.ShowRatesPerStay();
            Reservation.ShowAdditionalServices();
            Reservation.ShowGrandTotal();
            Reservation.GetBalance();            
        }
      });   
  
      $('#ratesperstay').on('input', function() {      
        if($(this).val().length > 0){         
            Reservation.ShowRatesPerDay();
            Reservation.ShowAdditionalServices();
            Reservation.ShowGrandTotal();
            Reservation.GetBalance();
        }        
      });


    $('#reservationForm').submit(function(e){        

           if($('#reservationForm .roomlistcard input:checked').length <= 0){
            $('.roomlistcard').removeClass('card-primary');
            $('.roomlistcard').addClass('card-danger');
            $('.roomlistcard div h3').text('Room/s: This field is required');    
            $('.roomlistcard').CardWidget('expand');
            $([document.documentElement, document.body]).animate({
                scrollTop: $(".roomlistcard").offset().top
            }, 2000);
            e.preventDefault();        
          }else{
            $('.roomlistcard').removeClass('card-danger');
            $('.roomlistcard').addClass('card-primary');
            $('.roomlistcard div h3').text('Room/s');
            
          } 
    });  
      
  
    /* $('#checkin').on('input', function() {
        $('#daystay').val(Reservation.DayStay()); 
        Reservation.ShowRatesPerStay(); //replaced
        Reservation.ShowAdditionalServices();
        Reservation.ShowGrandTotal();
        Reservation.GetBalance();
    }); */

    $('input[name="checkin"]').daterangepicker({
        singleDatePicker: true,
        autoApply: true,
        minDate: moment().add(0, 'days')
        
      }, function(checkin, end, label) {  
            var a = moment(checkin);
            var dateObj = new Date($('#checkout').val());
            var b = moment(dateObj);
            
            var days = b.diff(a, 'days');             
            var checkout = $('#checkout').val();
            if(days <=0 ){
                checkout = checkin;
                days = 0;
                $('#checkout').val(moment(checkin).format('MM/DD/YYYY'));
            }
            var newcheckoutObj = new Date($('#checkout').val());
            var newcheckout = moment(newcheckoutObj);
            var days = newcheckout.diff(a, 'days'); 
            if(days <=0 ){ 
                days = 0; 
            }
            
            /* Reservation.DayStay(moment(checkin).format('MM/DD/YYYY'), $('#checkout').val());        
            Reservation.RatesPerDay();  */
            $('#daystay').val(Reservation.DayStay(moment(checkin).format('MM/DD/YYYY'), $('#checkout').val()));        
            Reservation.DateRangePicker($('#checkout'), checkin); 
            Reservation.ShowRatesPerStay(); //replaced
            Reservation.ShowAdditionalServices();
            Reservation.ShowGrandTotal();
            Reservation.GetBalance(); 
        }
    );
  
      /* $('#checkout').on('input', function() {
        $('#daystay').val(Reservation.DayStay());
        Reservation.ShowRatesPerStay(); //replaced
        Reservation.ShowAdditionalServices();
        Reservation.ShowGrandTotal();
        Reservation.GetBalance();
      }); */

      $('#adults').on('input', function() {
            Reservation.ShowAdditionalServices();
            Reservation.ShowGrandTotal();
            Reservation.GetBalance();
      });
      $('#childs').on('input', function() {
            Reservation.ShowAdditionalServices();
            Reservation.ShowGrandTotal();
            Reservation.GetBalance();
        });

        $('#mealsamount').on('input', function() {
            Reservation.ShowGrandTotal();
            Reservation.GetBalance();
        });

        $('#prepayment').on('input', function() {
              Reservation.GetBalance();
        });
  
    /* $('.reservations').on('click', '.editreservation', function(e){        
        
        result= $(this).attr('href').split('/');
        reservation_id = result[result.length-2];
        //alert(reservation_id);
        
       // e.preventDefault();
    });
    $('.reservations').on('click', '.showreservation', function(e){
        
        reservation_id = this.href.substring(this.href.lastIndexOf('/') + 1);
        alert(reservation_id);
        
        e.preventDefault();
    });
    $('.reservations').on('click', '.cancelreservation', function(e){
        
        reservation_id = this.href.substring(this.href.lastIndexOf('/') + 1)
        alert(reservation_id);
        
        e.preventDefault();
    }); */
    Reservation.DateRangePicker($('#checkout'),  $('#checkin').val()); 
});
