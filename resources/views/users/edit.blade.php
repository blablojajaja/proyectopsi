{{-- @extends('layouts.appviews')
@section('content') --}}
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center font-weight-bolder">
                <h2 class="font-weight-bold">Cambiar tipo de usuario</h2>
            </div>
            {{-- <div class="pull-right">
                <a class="btn btn-primary" href="{{ users.index') }}" title="Go back"> <i
                        class="fas fa-backward "></i> </a>
            </div> --}}
        </div>
    </div>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Estatus:</strong>
                <select class="custom-select" name="usertype">
                    @switch($user->usertype)
                            @case(1)
                            <option value=1 selected>Empleado</option>
                            <option value=2>Admin.</option>
                            <option value=3>Superadmin.</option>
                            @break
                            @case(2)
                            <option value=1>Empleado</option>
                            <option value=2 selected>Admin.</option>
                            <option value=3>Superadmin.</option>
                            @break
                            @case(3)
                            <option value=1>Empleado</option>
                            <option value=2>Admin.</option>
                            <option value=3 selected>Superadmin.</option>
                            @break
                        @endswitch
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-primary" href="" data-dismiss="modal"> Cancelar</a>
            <button type="submit" class="btn btn-primary">Aceptar cambios</button>
        </div>
    </form>
{{-- @endsection --}}