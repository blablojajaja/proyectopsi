@extends('layouts.appviews')
@section('title', 'Categorías')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Categorias</h2>
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

    <div class="float-left">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/tickets') }}">Tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/sectors') }}">Sectores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active">Categorías</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/tickets/history') }}">Histórico</a>
            </li>
            @if((Auth::user()->usertype)== 3)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/users') }}">Usuarios</a>
            </li>
            @endif
        </ul>
    </div>
    <div class="float-right">
        <a class="btn btn-success text-light" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
            data-attr="{{ route('categories.create') }}" title="Crear una categoría">Crear categoría <i class="fas fa-plus-circle"></i>
        </a>
    </div>

    <table class="table table-bordered table-responsive-lg table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nombre</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td scope="row">{{ ++$i }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                            <a class="text-secondary" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                            data-attr="{{ route('categories.edit', $category->id) }}" title="Editar Categoria">
                                <i class="fas fa-edit text-gray-300"></i>
                            </a>
                            <a data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('categories.delete', $category->id) }}" title="Borrar Categoria">
                            <i class="fas fa-trash text-danger  fa-lg"></i>
                            </a>  
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
    {!! $categories->links() !!}
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
    </script>

@endsection