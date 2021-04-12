@extends('layouts.appviews')
@section('title', 'Histórico')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Histórico</h2>
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
                        <form action="{{ route('tickets.history') }}" method="GET" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control mr-2" name="term" placeholder="Escriba una palabra clave" id="term">
                                <span class="input-group-btn mr-5 mt-1">
                                    <button class="btn btn-info" type="submit" title="Buscar tickets">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
             </div>
        </div>
        <div id="filters" class="collapse">
            <div class="row">
                </br>
                <div class="card card-body">
                <form action="{{ route('tickets.history') }}" method="GET">
                    <div class="form-row">
                        <div class="col">
                            <strong>Estatus:</strong>
                            <select class="custom-select" name="status">
                            <option selected disabled >Elije uno</option>
                            <option value=1>Enviado</option>
                            <option value=2>En proceso</option>
                            <option value=3>Terminado</option>
                            </select>
                        </div>
                        <div class="col">
                            <strong>Categoría:</strong>
                            <select class="custom-select" name="category">
                            <option disabled selected >Elija una</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <strong>Sector:</strong>
                            <select class="custom-select" name="sector">
                            <option disabled selected >Elija uno</option>
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->name }}">{{ $sector->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <!-- <div class="col">
                            <strong>Fecha:</strong>
                            </br>
                            <input type="date"  name="created_at" value = null>
                        </div>
                        <div class="col"> -->
                            <div>
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function blockSrch() {
        var bsrch= document.getElementById("srch");
        var bfltr= document.getElementById("fltr");
        if (bsrch.disabled ==false){
            document.getElementById("srch").disabled = true;
        }else{
            document.getElementById("srch").disabled = false;
        }

        if (bfltr.innerText == 'Filtrar'){
            document.getElementById("fltr").innerText = 'Cerrar';
        }else{
            document.getElementById("fltr").innerText = 'Filtrar';
        }
        
    }
    function blockFltr() {
        var bfltr= document.getElementById("fltr");
        var bsrch= document.getElementById("srch");
        if (bfltr.disabled ==false){
            document.getElementById("fltr").disabled = true;
        }else{
            document.getElementById("fltr").disabled = false;
        }

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
                <a class="nav-link active">Histórico</a>
            </li>
            @if((Auth::user()->usertype)== 3)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/users') }}">Usuarios</a>
            </li>
            @endif
        </ul>
    </div>

    <div class="float-right">
        <button class="btn btn-primary" type="button" id="srch" data-toggle="collapse" data-target="#searchbar" onclick="blockFltr()">Buscar</button>
        <button class="btn btn-primary" type="button" id="fltr" data-toggle="collapse" data-target="#filters" onclick="blockSrch()">Filtrar</button>
        <a href="{{ route('tickets.history') }}" class=" mt-1">
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
                <th scope="col">Nombre</th>
                <th scope="col">Asunto</th>
                <th scope="col">Categoría</th>
                <th scope="col">Sector</th>
                <th scope="col">Fecha Creado</th>
                <th scope="col">Estatus</th>
                <th scope="col">Calificación</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->category }}</td>
                    <td>{{ $ticket->sector }}</td>
                    <td>{{ date_format($ticket->created_at, 'F j Y') }} , {{ date_format($ticket->created_at, 'g:i a') }}</td></td>
                    <td>
                        @switch($ticket->status)
                            @case(1)
                            Enviado
                            @break
                            @case(2)
                            En proceso de arreglo
                            @break
                            @case(3)
                            Terminado
                            @break
                        @endswitch
                    </td>
                    <td>
                    @isset($ticket->grade)
                    @for ($i = 1; $i <= $ticket->grade ; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @endisset

                    @empty($ticket->grade)
                        Evaluacion Pendiente
                    @endempty
                    </td>
                    <td>
                        <a data-toggle="modal" id="largeButton" data-target="#largeModal"
                            data-attr="{{ route('tickets.show', $ticket->id) }}" title="Mostrar Tickets">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>
                        @if($ticket->status != 3)
                        <a class="text-secondary" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                            data-attr="{{ route('tickets.edit', $ticket->id) }}" title="Actualizar estatus">
                            <i class="fas fa-edit text-gray-300"></i>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
    {!! $tickets->links() !!}
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