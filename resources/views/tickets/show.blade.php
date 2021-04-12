{{-- @extends('layouts.appviews')
@section('content') --}}
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>  {{ $ticket->name }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <p>  {{ $ticket->subject }}</p>
            </div>
        </div>
    </div>

    <div id="image" class="collapse">
        <img src="{{ Storage::url($ticket->image) }}" class="img-fluid" height="480" width="720" alt="" onclick="window.open(this.src)"/>
    </div>
    </br>
     @isset($ticket->image)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#image" id="btnimg" onclick="chngTitle()">Ver foto</button>
                <script>
                function chngTitle() {
                    var btnimg= document.getElementById("btnimg");
                    if (btnimg.innerText == 'Ver foto'){
                        document.getElementById("btnimg").innerText = 'Ocultar foto';
                    }else{
                        document.getElementById("btnimg").innerText = 'Ver foto';
                    }
                }
                </script>
        </div>
    </div>
    </br>
    @endisset
    @include('replies.commentsDisplay', ['replies' => $ticket->replies, 'id_ticket' => $ticket->id])
   
           
    <!-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <a class="btn btn-success text-light" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                data-attr="{{ route('replies.create', $ticket) }}" title="Create a reply"> Comentar<i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div> -->

    @if($ticket->status!=3)
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
    @endif
{{-- @endsection --}}