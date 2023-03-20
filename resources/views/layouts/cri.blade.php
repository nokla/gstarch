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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <link id="theme-style" rel="stylesheet" href="{{ asset('portal/css/portal.css') }}"> --}}
    <link id="theme-style" rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">





    <!-- Scripts -->
</head>
<body>
    <header class="header fixed-top">

        <div class="branding docs-branding">
            <div class="container-fluid position-relative py-2">
                <div class="docs-logo-wrapper">
	                <div class="site-logo"><a class="navbar-brand" href="/"><img class="logo-icon me-2" src="{{ asset('portal/images/psdconsulting.png')}}" alt="logo" height="32px"><span class="logo-text">PSD APPS-<span class="">Archivage</span></span></a></div>
                </div><!--//docs-logo-wrapper-->
	            <div class="docs-top-utilities d-flex justify-content-end align-items-center">
					<!--//social-list-->
		            <a href="{{ url('/home') }}" class="btn btn-primary d-none d-lg-flex">Administration</a>
	            </div><!--//docs-top-utilities-->
            </div><!--//container-->
        </div><!--//branding-->
    </header><!--//header-->


    <div class="page-header theme-bg-dark py-5 text-center position-relative">
	    <div class="theme-bg-shapes-right"></div>
	    <div class="theme-bg-shapes-left"></div>
	    <div class="container">
		    <h1 class="page-heading single-col-max mx-auto">Gestion Archive CRI</h1>
		    <div class="page-intro single-col-max mx-auto">Bienvenue à l'archive numérique de CRI, commencez-vous à explorer et à recherche les docuements de l'archive CRI.</div>
		    <div class="main-search-box pt-3 d-block mx-auto">
                 <form class="search-form w-100">
		            <input type="text" placeholder="Chercher..." name="search" class="form-control search-input">
		            <button type="submit" class="btn search-btn" value="Chercher"><i class="fas fa-search"></i></button>
		        </form>
             </div>
	    </div>
    </div><!--//page-header-->
   <div class="page-content">
	    <div class="container">
		    <div class="docs-overview py-5">
			    <div class="row justify-content-center">
                   @foreach ($cri as $item)
                       <!--//col-->
				    <div class="col-12 col-lg-4 py-3">
					    <div class="card shadow-sm">
						    <div class="card-body">
							    <h5 class="card-title mb-3">
								    <span class="theme-icon-holder card-icon-holder me-2">
                                        <svg class="svg-inline--fa fa-book-open-reader" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="book-open-reader" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M0 219.2v212.5c0 14.25 11.62 26.25 26.5 27C75.32 461.2 180.2 471.3 240 511.9V245.2C181.4 205.5 79.99 194.8 29.84 192C13.59 191.1 0 203.6 0 219.2zM482.2 192c-50.09 2.848-151.3 13.47-209.1 53.09C272.1 245.2 272 245.3 272 245.5v266.5c60.04-40.39 164.7-50.76 213.5-53.28C500.4 457.9 512 445.9 512 431.7V219.2C512 203.6 498.4 191.1 482.2 192zM352 96c0-53-43-96-96-96S160 43 160 96s43 96 96 96S352 149 352 96z"></path></svg>
							        </span><!--//card-icon-holder-->
							        <span class="card-title-text">{{ $item->code}}</span>
							    </h5>
							    <div class="card-text">
								    {{ $item->division }}
                                </div>
							    <a class="card-link-mask" href="docs-page.html#section-1"></a>
						    </div><!--//card-body-->
					    </div><!--//card-->
				    </div><!--//col-->
                   @endforeach


			    </div><!--//row-->
		    </div><!--//container-->
		</div><!--//container-->
    </div><!--//page-content-->

    <section class="cta-section text-center py-5 theme-bg-dark position-relative">
	    <div class="theme-bg-shapes-right"></div>
	    <div class="theme-bg-shapes-left"></div>
	    <div class="container">
		    <h3 class="mb-2 text-white mb-3">Launch Your Software Project Like A Pro</h3>
		    <div class="section-intro text-white mb-3 single-col-max mx-auto">Want to launch your software project and start getting traction from your target users? Check out our premium <a class="text-white" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderpro-bootstrap-5-startup-template-for-software-projects/">Bootstrap 5 startup template CoderPro</a>! It has everything you need to promote your product.</div>
		    <div class="pt-3 text-center">
			    <a class="btn btn-light" href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderpro-bootstrap-5-startup-template-for-software-projects/">Get CoderPro<i class="fas fa-arrow-alt-circle-right ml-2"></i></a>
		    </div>
	    </div>
    </section><!--//cta-section-->

    <footer class="footer">

	    <div class="footer-bottom text-center py-5">

		    <ul class="social-list list-unstyled pb-4 mb-0">
			    <li class="list-inline-item"><a href="#"><i class="fab fa-github fa-fw"></i></a></li>
	            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
	            <li class="list-inline-item"><a href="#"><i class="fab fa-slack fa-fw"></i></a></li>
	            <li class="list-inline-item"><a href="#"><i class="fab fa-product-hunt fa-fw"></i></a></li>
	            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f fa-fw"></i></a></li>
	            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-fw"></i></a></li>
	        </ul><!--//social-list-->

	        <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
            <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="theme-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>


	    </div>

    </footer>


    <!-- Javascript -->
    <script src="{{ asset('portal/js/jquery.min.js') }}"></script>
{{--     <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
 --}}    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <!-- Page Specific JS -->
    <script src="{{ asset('portal/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('portal/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('portal/plugins/fontawesome/js/all.min.js') }}"></script>

    <script src="{{ asset('portal/js/app.js') }}"></script>
    <!-- Page Specific JS -->
    <script src="{{ asset('assets/plugins/smoothscroll.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script src="{{ asset('assets/js/highlight-custom.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplelightbox/simple-lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/gumshoe/gumshoe.polyfills.min.js') }}"></script>
    <script src="{{ asset('assets/js/docs.js') }}"></script>

    <script>
        $( document ).ready(function() {

        });
    </script>
</body>
</html>
