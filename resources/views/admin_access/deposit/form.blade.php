{!! Form::open(array('url' => '#', 'id'=>'deposit_form', 'class'=>'form-horizontal', 'method' => 'post')) !!}

    <!--========Show form post message=============-->
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-2 form_messsage">
            
        </div>
    </div>
    <!--========End form post message=============-->
    <div class="form-group">
        <div class="col-md-2">
            <img src='{{ URL::asset("assets/admin_view/images/$card_type.png") }}' class="img-responsive" alt="">
        </div>
        <div class="col-md-5">
            <h5>Please provide the following details</h5>
            <input type="hidden" name="card_type" value="{{$card_type}}">
            <label for="">Amount</label>
            <input type="number" name="amount" id="deposit_amount" min="10" max="100" class="form-control form-required" placeholder="Amount">
            <br>
            <label for="">Card number</label>
            <input type="number" name="card_number" class="form-control form-required" placeholder="Card number">
            <br>
            <label for="">Card currency</label>
            <select name="currency" class="form-control form-required">
                <option value="euro">Euro</option>
            </select>
            <br>
            <label for="">Expiration date</label><br>
            <select name="exp_month" class="form-required">
                <option value="">-MM-</option>
                @for($i=1;$i<=12;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <select name="exp_year" class="form-required">
                <option value="">-YYYY-</option>
                @for($j=2019;$j<=2030;$j++)
                    <option value="{{ $j }}">{{ $j }}</option>
                @endfor
            </select>
            <br><br>
            <label for="">Security number</label>
            <input type="number" name="security_number" class="form-control form-required" placeholder="Security number" style="width: 80%;">
            <br>
            <p>Processing fee 1.75%</p>
        </div>
        <div class="col-md-5">
            <h4>Notes</h4>
            <ul>
                <li style="color: red;">This is just demo deposit workflow, actual process require more steps and validation than current</li>
                <li>Min amount 20</li>
                <li>Max amount 100</li>
            </ul>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-md-offset-2 col-md-7" style="padding-top: 15px;">
            <button type="submit" data-action="{{ route('post_deposit') }}" class="btn btn-success btn-sm form_submit">Deposit now</button>
        </div>
    </div>
{!! Form::close() !!}