<html>

<head>
    <title>GrupoDG P.S.I - @yield('title')</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Styles -->

    <link  rel="stylesheet" href="{{asset('css/app.css') }}">

</head>

<style>
.fa-star {
    color: orange;
}
</style>

<body>
    @section('sidebar')

    @show
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <img src="{{url('/images/customLogo.jpg')}}">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link">Bienvenido, {{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Salir</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <div class="container mt-5">
        @yield('content')
    </div>
    
</body>

</html>