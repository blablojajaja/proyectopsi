@extends('layouts.appviews')
@section('title', 'Tus Tickets')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tickets </h2>
            </div>
            
        </div>
    </div>
    @foreach ($tickets as $ticket)
        @if($ticket->status == 3)
            @empty($ticket->grade)
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                El estatus del ticket "{{$ticket->name}}" cambio a <strong>"Terminado"</strong>, por favor califique los resultados del ticket atendido.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endempty
        @endif
    @endforeach

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

    
    <div class="float-right">
        <a class="btn btn-success text-light" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
            data-attr="{{ route('tickets.create') }}" title="Create a ticket"> Crear Ticket <i class="fas fa-plus-circle"></i>
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

                    @if($ticket->status == 3)
                        @isset($ticket->grade)
                            @for ($i = 1; $i <= $ticket->grade ; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @endisset
                        @empty($ticket->grade)
                            <button class="btn btn-primary" type="button" title="Calificar ticket" data-toggle="modal" id="smallButton" data-target="#smallModal"
                            data-attr="{{ route('tickets.rate', $ticket->id) }}" >Calificar</button>
                        @endempty
                    @else
                        Pendiente
                    @endif

            
                    </td>
                    <td>
                            <a data-toggle="modal" id="largeButton" data-target="#largeModal"
                                data-attr="{{ route('tickets.show', $ticket->id) }}" title="Mostrar Ticket">
                                <i class="fas fa-eye text-success  fa-lg"></i>
                            </a>    
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