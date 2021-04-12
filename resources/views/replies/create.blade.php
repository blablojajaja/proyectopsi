{{-- @extends('layouts.appviews')
@section('content') --}}
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-center">
            <h2 class="font-weight-bold">Comentar ticket</h2>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>  {{ $ticket->name }}</h2>
            </div>
        </div>
    </div>


<form action="{{ route('replies.store')}}" method="POST" enctype="form-data">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Escribe tu comentario:</strong>
                <textarea name="text" class="form-control" aria-label="With textarea"></textarea>
                <input type="hidden" name="id_ticket" value="{{ $ticket->id }}" />
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-primary" href="" data-dismiss="modal"> Cancelar</a>

            <button type="submit" class="btn btn-primary">Comentar</button>
        </div>
    </div>

</form>
{{-- @endsection --}}