$(document).ready(function(){
    /* For Active Menu */
    $('.treeview-reservations').addClass('active');
    $('.btn-new-reservation').on('click', function(e){
        alert($(this).text());
        e.preventDefault();
    });
});
