$(document).ready(function(){
    /* For Active Menu */
    $('.treeview-reservations').addClass('active');    

    $('.reservations').on('click', '.editreservation', function(e){        
        
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
    });
});
