<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pagos') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/materialize.js') }}" defer></script>
    
    <script src="{{ asset('js/jquery-3.3.1.js') }}" defer></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    
    
    <!--<script src="{{ asset('js/tooltipster.bundle.min.js') }}" defer></script>-->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialize.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    
   <!-- <link href="{{ asset('css/tooltipster.bundle.min.css') }}" rel="stylesheet">-->
   
    
    
    <!-- <link rel=”stylesheet” href=”css/sweetalert.css”>
    <script src=”js/sweetalert.js”></script> -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>-->

    
    <!--<script src="/js/materialize.js"></script>
    <script src="/css/materialize.css"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>-->
            

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="#">Control Pagos</a>
              </div>
              <ul class="nav navbar-nav">
                <li class="active"><a href="http://localhost:8083/formulario">Pago por depósito</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Facturación
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="http://localhost:8083/invoice/create/0">Crear CFDI</a></li>
                    <li><a href="http://localhost:8083/invoice/massive">Crear CFDI's Masivos</a></li>
                    <li><a href="http://localhost:8083/invoice/createGlobal/0">Crear CFDI Global</a></li>
                    <li><a href="http://localhost:8083/invoice/index">Listar CFDI's</a></li>
                    
                  </ul>
                </li>
                <li class="active"><a href="http://localhost:8083/nota">Nota de Crédito</a></li>
            </ul>
        </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
