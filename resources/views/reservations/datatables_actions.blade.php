<form>
   
<div class='btn-group'>
    
    <a href="{{ route('reservations.edit', $reservation->id) }}" class='btn btn-success editreservation'>
        <i class="fa-solid fa fa-pen"></i> edit
    </a>
    <a href="{{ route('reservations.show', $reservation->id) }}" class='btn btn-primary showreservation'>
        <i class="fa fa-list"></i> show
    </a>
    <a href="{{ route('reservations.destroy', $reservation->id) }}" class='btn btn-danger cancelreservation'>
        <i class="fa fa-trash"></i> cancel
    </a>
    
</div>
</form>