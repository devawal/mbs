@extends('admin_access.layout.default')

@section('style')
	<style type="text/css">
		.cards{
			
		}
		.cards img{
			border: 1px solid #ccc;
		}
		.error-help-block{
			color: red;
		}
	</style>
@stop

@section('script')
	<script src="{{ URL::asset('assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('assets/plugins/jquery-validation/dist/additional-methods.min.js') }}" type="text/javascript"></script>

	<script type="text/javascript">
		$(document).ready(function() {
            var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
    		$.fn.modal.Constructor.prototype.enforceFocus = function() {};

    		// Modal calback
		    $('#modal_add_content').on('show.bs.modal', function (e) {

		        var modal_body = $(this).find('.modal-content');
		        modal_body.find('#body-content').html('');
		        modal_body.find('img.loader').show();

		    });

		    // Modal content add dialogue
		    $('#modal_add_content').on('shown.bs.modal', function (e) {

		        var modal_body  = $(this).find('.modal-content');
		        var button      = $(e.relatedTarget);
		        var action      = button.data('form');

		        $.ajax({
		            url: action,
		            type: 'GET',
		            dataType: 'html',
		            data: false,
		        })
		        .done(function(res) {
		            modal_body.find('img.loader').hide();
		            modal_body.find('#body-content').html(res);
		            var mt_title = modal_body.find('#body-content').find('.modal_top_title').text();
		        });

		    });

		    $(document.body).on('click', '.form_submit', function() {

		        var submit_btn  = $(this);
		        var form        = submit_btn.closest('form');
		        var action_url  = submit_btn.data('action');

		        form.validate({
		            errorElement: 'span', //default input error message container
		            errorClass: 'error-help-block', // default input error message class
		            //focusInvalid: false, // do not focus the last invalid input
		            ignore: [],
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
		                    dataPost(action_url, submit_btn);
		                }
		            }
		        });

		        // Form validation rules
		        $('.form-required').each(function () {
		            $(this).rules('add', {
		                required: true,
		                // messages: {
		                //     required: "Enter something else"
		                // }
		            });
		        });
		    });
        });

        // Data post ajax common function, like insert or update
	    function dataPost(action_url, submit_btn) {
	        var form        = submit_btn.closest('form');
	        var form_data   = new FormData();
	        var btn_text    = submit_btn.html();
	        
	        if (form.find('input').length > 0) {
	            form.find(':input:not(:checkbox, :radio)').each(function(index, el) {
	                if ($(this).attr('name')) {
	                    form_data.append($(this).attr('name'), $.trim($(this).val()));
	                }
	            });
	            form.find(':checkbox:checked, :radio:checked').each(function () {
	                form_data.append($(this).attr('name'), $(this).val());
	            });
	        }
	        if (form.find('select').length > 0) {
	            form.find('select').each(function(index, el) {
	                form_data.append($(this).attr('name'), $.trim($(this).val()));
	            });
	        }
	        if (form.find('textarea').length > 0) {
	            form.find('textarea').each(function(index, el) {
	                form_data.append($(this).attr('name'), $(this).val());
	            });
	        }
	        if (form.find('input[type=file]').length > 0) {
	            form.find('input[type=file]').each(function(index, el) {
	                if ($(this).get(0).files.length > 0 ) {
	                    form_data.append($(this).attr('name'), $(this).get(0).files[0]);
	                }
	            });
	        }
	        submit_btn.css('pointer-events', 'none').html('<i class="fa fa-refresh fa-spin"></i> '+btn_text);

	        $.ajax({
	            url: action_url,
	            dataType: 'json',
	            cache: false,
	            contentType: false,
	            processData: false,
	            async: true,
	            data: form_data,
	            type: 'post'
	        }).done(function(res) {
	            submit_btn.css('pointer-events', 'initial').html(btn_text);
	            if (res.flag==1) { // For data save response
	                //submit_btn.closest('form')[0].reset();
	                submit_btn.closest('form').find('.form_messsage').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+res.message+'</div>');
	                $('#modal_add_content').modal('hide');
	            } else { // For error response
	                submit_btn.closest('form').find('.form_messsage').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+res.message+'</div>');
	            }
	        })
	        .fail(function(err) {
	            submit_btn.css('pointer-events', 'initial').html(btn_text);
	            submit_btn.closest('form').find('.form_messsage').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Oops something went wrong!!</div>');
	        });
	    }
	</script>

@stop

@section('content')

	<section class="content-header">
		<h1>Deposit to your account</h1>
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
				<h4>Add some money to your account</h4>
				<p>To get started, select the option below that best suits you</p>
				
				<div class="row" style="margin-top: 40px;">
					<div class="col-md-2 col-sm-6">
						<div class="cards">
							<img src="{{ URL::asset('assets/admin_view/images/visa.png') }}" class="img-responsive" alt="">
							<a href="#" data-toggle="modal" data-target="#modal_add_content" data-form="{{ route('deposit_form') }}?card_type=visa"><strong>Deposit now</strong></a><br>
							<span>1.75% fee</span>
						</div>
					</div>
					<div class="col-md-2 col-sm-6">
						<div class="cards">
							<img src="{{ URL::asset('assets/admin_view/images/master.png') }}" class="img-responsive" alt="">
							<a href="#" data-toggle="modal" data-target="#modal_add_content" data-form="{{ route('deposit_form') }}?card_type=master"><strong>Deposit now</strong></a><br>
							<span>1.75% fee</span>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>

	<div class="modal fade" id="modal_add_content" tabindex="-1" role="dialog">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title">Deposit to your account</h4>
	            </div>
	            <div class="modal-body">
	                <img src="{{ URL::asset('assets/admin_view/images/loader.gif') }}" alt="" class="loader center-block">
	                <div id="body-content">
	                    
	                </div>
	            </div>
	            <div class="modal-footer">
	                <!--<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('common.modal_close') }}</button>-->
	            </div>
	        </div>
	    </div>
	</div>
@stop