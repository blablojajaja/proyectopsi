{{-- @extends('layouts.appviews')
@section('content') --}}

    <style>
        
		
		em {
			display: block;
			margin: .5em auto 2em;
			color: #bbb;
		}

		p, p a { 
			color: #aaa;
			text-decoration: none;
		}
		p a:hover,
		p a:focus {
			text-decoration: underline;
		}
		p + p { color: #bbb; margin-top: 2em;}
		.detail {position: absolute; text-align: right; right: 5px; bottom: 5px; width: 50%;}
		
		a[href*="intent"] {
			display:inline-block;
			margin-top: 0.4em;
		}

		/*  
		 * Rating styles
		 */
		.rating {
			width: 226px;
			margin: 0 auto 1em;
			font-size: 45px;
			overflow:hidden;
		}
        .rating input {
        float: right;
        opacity: 0;
        position: absolute;
        }
		.rating a,
        .rating label {
                float:right;
                color: #aaa;
                text-decoration: none;
                -webkit-transition: color .4s;
                -moz-transition: color .4s;
                -o-transition: color .4s;
                transition: color .4s;
            }
        .rating label:hover ~ label,
        .rating input:focus ~ label,
        .rating label:hover,
		.rating a:hover,
		.rating a:hover ~ a,
		.rating a:focus,
		.rating a:focus ~ a		{
			color: orange;
			cursor: pointer;
		}
		.rating2 {
			direction: rtl;
		}
		.rating2 a {
			float:none
		}
    </style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center font-weight-bolder">
                <h2 class="font-weight-bold">Calificar ticket</h2>
            </div>
            {{-- <div class="pull-right">
                <a class="btn btn-primary" href="{{ tickets.index') }}" title="Go back"> <i
                        class="fas fa-backward "></i> </a>
            </div> --}}
        </div>
    </div>

    <form action="{{ route('tickets.setGrade', $ticket->id) }}" method="POST">
        @csrf
        @method('POST')

        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Indique cuantas estrellas le daría a la atención de este ticket </strong>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <div class="rating">
                <input name="grade" id="e5" type="submit" value="5"></a><label for="e5">☆</label>
                <input name="grade" id="e4" type="submit" value="4"></a><label for="e4">☆</label>
                <input name="grade" id="e3" type="submit" value="3"></a><label for="e3">☆</label>
                <input name="grade" id="e2" type="submit" value="2"></a><label for="e2">☆</label>
                <input name="grade" id="e1" type="submit" value="1"></a><label for="e1">☆</label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-primary" href="" data-dismiss="modal"> Cancelar</a>
        </div>
    </form>
{{-- @endsection --}}