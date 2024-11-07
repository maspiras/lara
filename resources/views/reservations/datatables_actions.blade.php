<form>
<div class='btn-group'>
    
    <a href="{{ route('reservations.edit', $reservation->id) }}" class='btn btn-success'>
        <i class="glyphicon glyphicon-eye-open"></i>edit
    </a>
    &nbsp;
    <a href="{{ route('reservations.show', $reservation->id) }}" class='btn btn-primary'>
        <i class="glyphicon glyphicon-edit"></i>show
    </a>
    &nbsp;
    <a href="{{ route('reservations.destroy', $reservation->id) }}" class='btn btn-danger'>
        <i class="glyphicon glyphicon-edit"></i>cancel
    </a>
    
</div>
</form>