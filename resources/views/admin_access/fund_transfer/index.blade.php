@extends('admin_access.layout.default')

@section('style')
	<style type="text/css">
		ul li{
			color: red;
		}
	</style>
@stop

@section('script')

	<script type="text/javascript">
		$(document).ready(function() {
            $(document.body).on('change', '#from_account', function(event) {
            	
            	var acc = $(this).val();
            	if (acc != '') {
            		$.ajax({
            			url: baseUrl+'account/get-balance',
            			type: 'GET',
            			dataType: 'json',
            			data: {account_id: acc},
            		})
            		.done(function(res) {
            			if (res) {
            				$('#available').val(res.balance);
            				$('#currency').val(res.currency);
            			}
            		});
            	}
            });

            $(document.body).on('blur', '#amount', function(event) {
            	var amount = $(this).val();
            	console.log(amount);
            });
        });
	</script>

@stop

@section('content')

	<section class="content-header">
		<h1>Transfer money</h1>
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

		<div class="panel panel-default">
			<div class="panel-body">
				
				<div class="row">
					<div class="col-md-8">
						<h4>Transfer money within MBS</h4><br>

						{!! Form::open(array('route' => array('post_transfer'), 'method' => 'post', 'id'=>'fund_transfer_form', 'class' =>'form-horizontal')) !!}
							<div class="form-group form-error">
								{!! Form::label('from_account', 'From account', array('class' => 'col-md-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-8 col-sm-8 col-xs-12">
									<select name="from_account" id="from_account" class="form-control">
										<option value="">Select account</option>
										<option value="{{ $account->account_number }}">{{ $account->account_number }}</option>
									</select>
								</div>
							</div>
							<div class="form-group form-error">
								{!! Form::label('available', 'Available balance', array('class' => 'col-md-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="available" id="available" class="form-control" readonly="" placeholder="Available balance">
								</div>
							</div>
							<div class="form-group form-error">
								{!! Form::label('currency', 'Currency', array('class' => 'col-md-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="currency" id="currency" class="form-control" readonly="" placeholder="Currency">
								</div>
							</div>
							<div class="form-group form-error">
								{!! Form::label('to_account', 'To account', array('class' => 'col-md-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="number" name="to_account" id="to_account" class="form-control" required="" placeholder="To account">
								</div>
							</div>
							<div class="form-group form-error">
								{!! Form::label('amount', 'Transfer Amount', array('class' => 'col-md-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="number" name="amount" id="amount" class="form-control" min="10" max="100" required="" placeholder="Transfer Amount">
								</div>
							</div>
							<div class="form-group form-error">
								{!! Form::label('remerks', 'Remarks', array('class' => 'col-md-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text" name="remerks" id="remerks" class="form-control" required="" placeholder="Remerks">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<button type="submit" class="btn btn-success">Transfer</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="col-md-4">
						<h4>Notes</h4>
						<ul>
							<li>This is a test fund transfer, actual transfer require more steps than current.</li>
							<li>Transfer is currently limited to MBS only.</li>
							<li>For demo purpose MBS only accept valid account ID which is 16 digit length.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</section>
@stop