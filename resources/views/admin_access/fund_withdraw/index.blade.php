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
            	var balance = $('#available').val();
            	if (amount != '') {
            		var service_charge = (parseInt(amount)*2.5)/100;
            		amount = parseInt(amount) + service_charge;
            		if (amount > balance) {
            			$(this).val('');
	            		alert('Account balance exceed!');
            		}
            	}
            });
        });
	</script>

@stop

@section('content')

	<section class="content-header">
		<h1>Fund withdraw</h1>
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
						<h4>Fund withdrawal using bank</h4><br>

						{!! Form::open(array('route' => array('post_withdraw'), 'method' => 'post', 'id'=>'fund_withdraw', 'class' =>'form-horizontal')) !!}
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
								{!! Form::label('to_account', 'Withdrawal account', array('class' => 'col-md-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="number" name="to_account" id="to_account"  class="form-control" required="" placeholder="Withdrawal account">
								</div>
							</div>
							<div class="form-group form-error">
								{!! Form::label('amount', 'Withdrawal Amount', array('class' => 'col-md-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="number" name="amount" id="amount" class="form-control" min="10" max="100" required="" placeholder="Withdrawal amount">
								</div>
							</div>
							<div class="form-group form-error">
								{!! Form::label('service_charge', 'Service charge%', array('class' => 'col-md-4 col-sm-4 col-xs-12 control-label')) !!}
								<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="number" name="service_charge" id="service_charge" class="form-control" readonly="" value="2.5" placeholder="Service charge">
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
									<button type="submit" class="btn btn-success">Withdraw</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<div class="col-md-4">
						<h4>Notes</h4>
						<ul>
							<li>This is a test fund withdraw, actual withdraw require more steps than current.</li>
							<li>Transfer is currently possible only bank.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</section>
@stop