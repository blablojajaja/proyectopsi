{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('sectors.destroy', $sector->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">¿Estás seguro que quieres borrar {{ $sector->name }} ?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Si, borrar sector</button>
    </div>
</form>