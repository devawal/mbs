@extends('admin_access.layout.default')

@section('content')

	<section class="content-header">
		<h1>Dashboard <small></small>
		</h1>
	</section>

	<section class="content">

		<table class="table table-responsive">
			<thead>
				<th>Account Number</th>
				<th>Account Type</th>
				<th>Available Balance</th>
				<th>Currency</th>
				<th>Status</th>
			</thead>
			<tbody>
				@if(!empty($account))
					<tr>
						<td>{{ $account->account_number }}</td>
						<td>{{ $account->account_type }}</td>
						<td>{{ $account->current_balance }}</td>
						<td>{{ ucfirst($account->currency) }}</td>
						<td>{{ $account->is_active == 1 ? 'Active' : 'Inactive' }}</td>
					</tr>
				@endif
			</tbody>
		</table>

	</section>

@stop