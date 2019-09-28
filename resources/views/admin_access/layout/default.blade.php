<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ isset($title) ? $title : "Admin" }}</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css') }}">
		<!-- Ionicons -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/ionicons.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ URL::asset('assets/admin_view/css/AdminLTE.css') }}">
		<!-- Sweet alert -->
		<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sweet-alert/sweetalert.css') }}">
		<!-- Admin Skins -->
		<link rel="stylesheet" href="{{ URL::asset('assets/admin_view/css/all-color-skins.css') }}">
		<!-- Custom CSS for admin dashboard -->
		<link rel="stylesheet" href="{{ URL::asset('assets/admin_view/css/admin-dashboard.css') }}">

		<!-- Page css -->
		@yield('style')

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="hold-transition skin-purple sidebar-mini">
		
		<div class="wrapper">
			<!--==========Header=======-->
			@include('admin_access.layout.header')
			<!--=======End of Header====-->
			
			<!--==========Sidebar=======-->
			@include('admin_access.layout.sidebar')
			<!--=======End of Sidebar====-->

			<!--==========Content=======-->
			<div class="content-wrapper">

				@yield('content')

			</div>
			<!--=======End of Content====-->

			<!--==========Footer=======-->
			@include('admin_access.layout.footer')
      		<!--=======End of footer====-->

		</div>


		<!-- jQuery 2.1.4 -->
	    <script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js') }}" type="text/javascript"></script>
	    <!-- Bootstrap 3.3.6 -->
	    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
	    <!-- SlimScroll 1.3.0 -->
		<script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
	    <!-- Sweet alert -->
	    <script src="{{ URL::asset('assets/plugins/sweet-alert/sweetalert.min.js') }}" type="text/javascript"></script>
	    <!-- Admin App -->
	    <script src="{{ URL::asset('assets/admin_view/js/admin.js') }}" type="text/javascript"></script>
	    <!-- Page script -->
	    <script type="text/javascript">
	    	var baseUrl = "{{ asset('') }}";
	    </script>
		@yield('script')

	</body>
</html>