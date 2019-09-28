<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Login Panel</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
	    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css') }}">
	    <!-- Ionicons -->
	    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	    <!-- Theme style -->
	    <link rel="stylesheet" href="{{ URL::asset('assets/admin_view/css/AdminLTE.min.css') }}">
	    <!-- iCheck -->
	    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/square/blue.css') }}">

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body class="hold-transition login-page">

		<div class="login-box">
			<div class="login-logo">
				<a href="{{ route('login') }}"><b>User</b> Login</a>
			</div>
			<div class="login-box-body">
				
				<!--========Session message=======-->
				@if (Session::has('success'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{ Session::get('error') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                      <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          {{ $error }}
                      </div>
                    @endforeach
                @endif
				<!--======end Session message=====-->

				<p class="login-box-msg">Sign in to start your session</p>

				{!! Form::open(array('route' => 'user_authentication', 'method' => 'post' )) !!}
					
					<div class="form-group has-feedback">
						{!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Username or email')) !!}
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						{!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) !!}
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<div class="checkbox icheck">
								<label>
									{!! Form::checkbox('remember', '1') !!} Remember Me
								</label>
							</div>
						</div>
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
						</div>
					</div>
				{!! Form::close() !!}

				<div class="social-auth-links text-center">
					<p>- OR -</p>
					<!-- <a href="#" class="btn btn-block btn-social btn-facebook btn-flat">
						<i class="fa fa-facebook"></i> Sign in using Facebook
					</a>
					<a href="#" class="btn btn-block btn-social btn-google btn-flat">
						<i class="fa fa-google-plus"></i> Sign in using Google+
					</a> -->
				</div>
				
				<!-- <a href="#">I forgot my password</a><br> -->
				<a href="{{ route('user_registration') }}" class="text-center">Register for new account</a>

			</div>
		</div>

		<!-- jQuery 2.1.4 -->
		<script src="{{ URL::asset('assets/js/jquery-1.11.3.min.js') }}"></script>
		<!-- Bootstrap 3.3.6 -->
	    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	    <!-- iCheck -->
	    <script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js') }}"></script>

	    <script type="text/javascript">
			$(function () {
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});
			});
		</script>
	</body>
</html>