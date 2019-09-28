<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>New Account</title>
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
	    <style>
	    	.help-block{
					color: red;
				}
	    </style>
	</head>
	<body class="hold-transition login-page">

		<div class="login-box">
			<div class="login-logo">
				<a href="{{ route('login') }}"><b>User</b> Registration</a>
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

				{!! Form::open(array('route' => 'post_registration', 'method' => 'post', 'id' => 'registration_form')) !!}
					<div class="form-group has-feedback">
						{!! Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=>'First name')) !!}
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						{!! Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=>'Last name')) !!}
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						{!! Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Email')) !!}
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						{!! Form::text('code', null, array('class'=>'form-control', 'placeholder'=>'Personal code')) !!}
						<span class="glyphicon glyphicon-flag form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						{!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password', 'id' => 'password')) !!}
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						{!! Form::password('repassword', array('class'=>'form-control', 'placeholder'=>'Confirm password', 'id' => 'repassword')) !!}
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
					</div>
				{!! Form::close() !!}

			</div>
		</div>

		<!-- jQuery 2.1.4 -->
		<script src="{{ URL::asset('assets/js/jquery-1.11.3.min.js') }}"></script>
		<!-- Bootstrap 3.3.6 -->
	    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	    <!-- iCheck -->
	    <script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js') }}"></script>

	    <script src="{{ URL::asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
		<script src="{{ URL::asset('assets/plugins/jquery-validation/dist/additional-methods.min.js') }}" type="text/javascript"></script>

	    <script type="text/javascript">
	    	$(document).ready(function() {
	    		$("#registration_form").validate({
		            errorElement: 'span', //default input error message container
		            errorClass: 'help-block', // default input error message class
		            //focusInvalid: false, // do not focus the last invalid input
		            //ignore: "",
		            rules: {
		                first_name: {
		                    required: true, minlength: 3,
		                },
		                last_name: {
		                    required: true, minlength: 3,
		                },
		                email: {
		                    required: true, email: true,
		                },
		                code: {
		                    required: true, number: true, minlength: 13,maxlength: 13,
		                },
		                password: {
		                    required: true, minlength: 6,
		                },
		                repassword: {
		                     required: true, equalTo: "#password", minlength: 6,
		                },
		            },
		            // errorPlacement: function (error, element) {
		            //     if(element.attr("name") == "currentpassword") error.appendTo("#cr_pass_error")
		            //     else error.insertAfter($(element))
		            // },
		            highlight: function (element) { // hightlight error inputs
		                $(element).closest('.form-group').addClass('form-error'); // set error class to the control group
		            },

		            unhighlight: function (element) { // revert the change done by hightlight
		                $(element).closest('.form-group').removeClass('form-error'); // set error class to the control group
		            },

		            success: function (label) {
		                label.closest('.form-group').removeClass('form-error'); // set success class to the control group
		            },
		            submitHandler: function (form, event) {
		                event.preventDefault();
		                if (form) {
		                    form.submit();
		                }
		            }
		        });
	    	});
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