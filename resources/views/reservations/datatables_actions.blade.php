<form>
   
<div class='btn-group'>
    
    <a href="{{ route('reservations.edit', $reservation->id) }}" class='btn btn-success editreservation'>
        <i class="glyphicon glyphicon-eye-open"></i>edit
    </a>
    <a href="{{ route('reservations.show', $reservation->id) }}" class='btn btn-primary showreservation'>
        <i class="glyphicon glyphicon-edit"></i>show
    </a>
    <a href="{{ route('reservations.destroy', $reservation->id) }}" class='btn btn-danger cancelreservation'>
        <i class="glyphicon glyphicon-edit"></i>cancel
    </a>
    
</div>
</form>