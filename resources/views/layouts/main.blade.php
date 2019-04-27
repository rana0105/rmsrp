<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	{{-- <link rel="icon" href="img/favicon.png" type="image/png"> --}}
	<title>Routine Management</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/vendors/linericon/style.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/vendors/owl-carousel/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/vendors/lightbox/simpleLightbox.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/vendors/nice-select/css/nice-select.css') }}') }}">
	<link rel="stylesheet" href="{{ asset('frontend/vendors/animate-css/animate.css') }}">
	<!-- main css -->
	<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
	@yield('css')
</head>

<body>
@include('partial.navbar')
@yield('content')
@yield('js')
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('frontend/js/popper.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/stellar.js') }}"></script>
	<script src="{{ asset('frontend/js/countdown.js') }}"></script>
	<script src="{{ asset('frontend/vendors/nice-select/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('frontend/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('frontend/js/owl-carousel-thumb.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
	<script src="{{ asset('frontend/vendors/counter-up/jquery.counterup.js') }}"></script>
	<script src="{{ asset('frontend/js/mail-script.js') }}"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src={{ asset('frontend/js/gmaps.min.js') }}"></script>
	<script src={{ asset('frontend/js/theme.js') }}"></script>
</body>

</html>