{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('categories.destroy', $category->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">¿Estás seguro que quieres borrar {{ $category->name }} ?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Si, borrar categoría</button>
    </div>
</form>