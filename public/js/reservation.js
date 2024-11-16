$(document).ready(function(){    
    /* For Active Menu */
    $('.treeview-reservations').addClass('active'); 

    var Reservation = {
        DayStay: function(frm, e){
          if($('#checkin').val() != '' && $('#checkout').val() != ''){
            var d1 = new Date($('#checkin').val());   
            var d2 = new Date($('#checkout').val());       
            var diff = ( d2.getTime() - d1.getTime() ) / (1000 * 60 * 60 * 24);              
            $('#daystay').val(diff);
          }
          //e.preventDefault();
        },
        RatesPerDay: function(frm, e){        
          var ratesperstay = (Math.round($('#ratesperday').val() * $('#daystay').val() * 100) / 100).toFixed(2);
          if($('#daystay').val() == 0){
            $('#ratesperstay').val($('#ratesperday').val());
          }else{
            //(Math.round(num * 100) / 100).toFixed(2)
            //$('#ratesperstay').val($('#ratesperday').val() * $('#daystay').val());          
            $('#ratesperstay').val(ratesperstay);
            $('#balance').val(ratesperstay);
          }
          
        },
        RatesPerStay: function(frm, e){        
          //$('#ratesperday').val($('#ratesperstay').val() / $('#daystay').val());
          var ratesperstay = (Math.round($('#ratesperstay').val() / $('#daystay').val() * 100) / 100).toFixed(2);
          //ratesperstay = $('#ratesperstay').val() / $('#daystay').val();
         // var val = $( "input[name='daystay']" ).val();
          
         if($('#daystay').val() == 0){
            $('#ratesperday').val($('#ratesperstay').val());
         }else{
            $('#ratesperday').val(ratesperstay);
            $('#balance').val(ratesperstay);
         }
          
        },
        GetBalance: function(){
          var balance = Number($('#ratesperstay').val()) - Number($('#prepayment').val());
          if(Number($('#ratesperstay').val()) > Number($('#prepayment').val())){
            $('#balance').val(balance);
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
            return  CommonLib.MoneyFormat(amount);
        },
        RemoveService: function(input){
            input.remove();            
        },
        RemoveServicesCard: function(){
            $('.servicestotalamount').text('0.00');
            $('.serviceschosen').children().remove();
            $('.servicescard').CardWidget('collapse');
            
        }
    } /* End of class Reservation */


    
    
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
        var checkboxes = $('input[name="services[]"]:checked');        
        if(checkboxes.length > 0){
            
            $('.serviceschosen').children().remove();            
            $('.servicestotalamount').text('0.00');

            checkboxes.each(function(i){
                $('.serviceschosen').prepend('<div class="service"><div class="form-group row"><p for="inputEmail3" class="col-lg-7 col-md-7 col-7 col-form-label">'+$(this).prop('title')+'</p><div class="col-lg-4 col-md-4 col-4"><input type="hidden" id="service_id'+i+'" name="service_id[]" value="'+$(this).val()+'"><input type="number" class="form-control col servicesamount" id="serviceamount'+i+'" name="servicesamount[]" placeholder="0.00"></div><div class="col-lg-1 col-md-1 col-1"><a href="'+config.SitePath+'/services/'+$(this).val()+'" class="btn btn-danger services_delete"><i class="fa fa-trash"></i></a></div></div><div class="form-group row"><p for="inputPassword3" class="col-lg-7 col-7 col-form-label">Status</p><div class="col-lg-5 col-5"><select class="form-control" id="services-status'+i+'" name="servicepaymentstatus"><option value="0">No payment</option><option value="1">Paid</option></select></div></div><hr class="hr" /></div>');  
            });
            $('.servicescard').CardWidget('expand');            
        }else{
            Reservation.RemoveServicesCard();
        }
        $('.servicesmodal').modal('hide');
        
        e.preventDefault();
    } );


    $('.serviceschosen').on('input', '.servicesamount', function(e) {               
        $('.servicestotalamount').text(Reservation.GetServicesTotal());
        e.preventDefault();
    });

    /* Delete services to services chosen */
    $('.serviceschosen').on('click', '.services_delete', function(e) {          
        //$(this).closest('.service').remove();
        Reservation.RemoveService($(this).closest('.service'));
        $('.servicestotalamount').text(Reservation.GetServicesTotal());
        //alert(Reservation.GetServicesTotal());
        e.preventDefault();
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
});
