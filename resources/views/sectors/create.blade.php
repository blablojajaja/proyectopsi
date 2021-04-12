{{-- @extends('layouts.appviews')
@section('content') --}}
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-center">
            <h2 class="font-weight-bold">Añadir nuevo sector</h2>
        </div>

    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ocurrió un error.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('sectors.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="name" class="form-control" placeholder="Nombre">
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-primary" href="" data-dismiss="modal"> Cancelar</a>

            <button type="submit" class="btn btn-primary">Crear</button>
        </div>
    </div>

</form>
{{-- @endsection --}}