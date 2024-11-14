$(document).ready(function(){
    /* For Active Menu */
    $('.treeview-reservations').addClass('active'); 
    
    
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
            $('.mealscard').CardWidget('toggle');   
            
        }
        e.preventDefault();
    } );  
    
    $( ".btn-services" ).on( "click", function(e) {               
        $('.servicesmodal').modal('show');
        e.preventDefault();
    } );

    $( ".btn-services-okay" ).on( "click", function(e) {       
        $('.servicesmodal').modal('hide');
        $('.servicescard').CardWidget('toggle');        
        e.preventDefault();
    } );
    

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
