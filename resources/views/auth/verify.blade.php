@extends('layouts.app')
@section('title', 'Verificar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reescribe tu correo electrónico</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Un link de reestablecimiento ha sido enviado a su correo electrónico
                        </div>
                    @endif

                    Antes de continuar, por favor revisa tu correo electrónico por un enlace de verificación.
                    Si no has recibido el correo electrónico,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">haz click aqui para solicitar otro.</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
