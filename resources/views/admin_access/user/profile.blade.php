@extends('admin_access.layout.default')

@section('style')

	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/square/blue.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/admin_view/css/user.css') }}">

@stop

@section('script')

	<script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('assets/plugins/jquery-validation/dist/additional-methods.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('assets/admin_view/js/user.js') }}" type="text/javascript"></script>

	<script type="text/javascript">
		$(document).ready(function() {
            UserProfile.init();
        });
	</script>

@stop

@section('content')

	<section class="content-header">
		<h1>User Profile</h1>
		<div class="row">
			<div class="col-md-5 col-sm-6 col-xs-12">

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
				
			</div>
		</div>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#change_password" data-toggle="tab" aria-expanded="false">Change password</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="change_password">
							{!! Form::open(array('route' => array('update_user_password'), 'method' => 'post', 'id'=>'update_password_form', 'class' =>'form-horizontal')) !!}
								<div class="form-group form-error">
									{!! Form::label('currentpassword', 'Current password', array('class' => 'col-md-2 col-sm-2 col-xs-12 control-label')) !!}
									<div class="col-md-9 col-sm-9 col-xs-12">
										{!! Form::password('currentpassword', array('class'=>'form-control', 'placeholder'=>'Current password')) !!}
									</div>
								</div>
								<div class="form-group form-error">
									{!! Form::label('password', 'New password', array('class' => 'col-md-2 col-sm-2 col-xs-12 control-label')) !!}
									<div class="col-md-9 col-sm-9 col-xs-12">
										{!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'New password')) !!}
									</div>
								</div>
								<div class="form-group form-error">
									{!! Form::label('repassword', 'Confirm password', array('class' => 'col-md-2 col-sm-2 col-xs-12 control-label')) !!}
									<div class="col-md-9 col-sm-9 col-xs-12">
										{!! Form::password('repassword', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) !!}
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-success">Update</button>
									</div>
								</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
@stop