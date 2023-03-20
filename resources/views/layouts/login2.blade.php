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

    <title>PSD APPS-Facilitaion</title>

    <!-- App CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link id="theme-style" rel="stylesheet" href="{{ asset('portal/css/portal.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- FontAwesome JS-->
    <script defer src="{{ asset('portal/plugins/fontawesome/js/all.min.js') }}"></script>


    <!-- Scripts -->
</head>
<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="./"><img class="logo-icon me-2" src="{{ asset('portal/images/psdconsulting.png')}}" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">PSD APPS-Facilitaion</h2>
			        <div class="auth-form-container text-start">
						@yield('login')
						<div class="auth-option text-center pt-5"> </div>
					</div><!--//auth-form-container-->

			    </div><!--//auth-body-->

			    <footer class="app-auth-footer">

				    <div class="container text-center py-3 align-content-center">
                        <div class="row p-3 mx-auto align-content-center">
                            <div class="col-md-2"><!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
                                <small class="copyright">PSD &copy; 2023</small></div>
                                <div class="col-md-2"><img class="logo-icon me-2" src="{{ asset('img/psdconsulting.png')}}" alt="logo" width="60%"></div>
                            <div class="col-md-2"><img class="logo-icon me-2" src="{{ asset('img/psdexperts.png')}}" alt="logo" width="60%"></div>
                             <div class="col-md-2"><img class="logo-icon me-2" src="{{ asset('img/psdapps.png')}}" alt="logo" width="60%"></div>
                        </div>


				    </div>
			    </footer><!--//app-auth-footer-->
		    </div><!--//flex-column-->
	    </div><!--//auth-main-col-->
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>

				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->


    </div><!--//row-->
    <!-- Javascript -->
    <script src="{{ asset('portal/js/jquery.min.js') }}"></script>
    <script src="{{ asset('portal/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('portal/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Charts JS -->
    <script src="{{ asset('portal/plugins/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('portal/js/index-charts.js') }}"></script>

    <!-- Page Specific JS -->
    <script src="{{ asset('portal/js/app.js') }}"></script>
    @yield('script')
</body>
</html>
