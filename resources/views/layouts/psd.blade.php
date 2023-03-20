<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Application de gestion des archives">
    <meta name="author" content="PSD APPS">
    <link rel="shortcut icon" href="favicon.ico">

    <title>PSD APPS-Archivage</title>

    <!-- App CSS -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link id="theme-style" rel="stylesheet" href="{{ asset('portal/css/portal.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @yield('cssfiles')
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('portal/plugins/fontawesome/js/all.min.js') }}"></script>
    <!-- Scripts -->
    <style>

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);
}

.nested {
  display: none;
}

.active {
  display: block;
}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body class="app">
    @include('layouts.ext.head')
    <!--//app-header-->

    <div class="app-wrapper">

	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">

                <h1 class="app-page-title">@yield('title')</h1>
			    @yield('main')



		    </div><!--//container-fluid-->
	    </div><!--//app-content-->

	    @include('layouts.ext.foot')<!--//app-footer-->

    </div><!--//app-wrapper-->


    <!-- Javascript -->
    <script src="{{ asset('portal/js/jquery.min.js') }}"></script>
{{--     <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
--}}

<script src="{{ asset('portal/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <!-- Page Specific JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('portal/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('portal/plugins/bootstrap/js/bootstrap.min.js') }}"></script>  --}}

    <!-- Charts JS -->
    <script src="{{ asset('portal/plugins/chart.js/chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('jsfiles')

    <script>
        $( document ).ready(function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
            });
            @yield('script')


            //select2
            $('.js-select2').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });
    </script>
</body>
</html>
