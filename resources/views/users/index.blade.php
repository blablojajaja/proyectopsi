@extends('layouts.appviews')
@section('title', 'Tickets')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Usuarios </h2>
            </div>
            
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oh, no!</strong> Existen algunos problemas con el formulario.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container">
        <div id="searchbar" class="collapse">
            <div class="row">
                    </br>
                    <div class="card card-body">
                        <form action="{{ route('users.index') }}" method="GET" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control mr-2" name="term" placeholder="Escriba una palabra clave" id="term">
                                <span class="input-group-btn mr-5 mt-1">
                                    <button class="btn btn-info" type="submit" title="Buscar usuarios">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
             </div>
        </div>
    </div>

    <script>
    function changeSrch() {
        var bsrch= document.getElementById("srch");
        if (bsrch.innerText == 'Buscar'){
            document.getElementById("srch").innerText = 'Ocultar';
        }else{
            document.getElementById("srch").innerText = 'Buscar';
        }
    }
    </script>

    <div class="float-left">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/tickets') }}">Tickets</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/sectors') }}">Sectores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/categories') }}">Categorías</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/tickets/history') }}">Histórico</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active">Usuarios</a>
        </li>
    </ul>
    </div>
    
    <div class="float-right">
        <button class="btn btn-primary" type="button" id="srch" data-toggle="collapse" data-target="#searchbar" onclick="changeSrch()">Buscar</button>
        <a href="{{ route('users.index') }}" class=" mt-1">
            <span class="input-group-btn">
                <button class="btn btn-danger" type="button" title="Recargar tabla">
                    <span class="fas fa-sync-alt"></span>
                </button>
            </span>
        </a>
    </div>

    <table class="table table-bordered table-responsive-lg table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>@switch($user->usertype)
                            @case(1)
                            Empleado
                            @break
                            @case(2)
                            Admin.
                            @break
                            @case(3)
                            Superadmin.
                            @break
                        @endswitch
                    </td>
                    <td>
                        <a class="text-secondary" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                            data-attr="{{ route('users.edit', $user->id) }}" title="Actualizar Tipo de usuario">
                            <i class="fas fa-edit text-gray-300"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
    {!! $users->links() !!}
    </div>


    <!-- small modal -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- large modal -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="largeBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
        // display a modal (medium modal)
        $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        // display a modal (large modal)
        $(document).on('click', '#largeButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#largeModal').modal("show");
                    $('#largeBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

    </script>

@endsection