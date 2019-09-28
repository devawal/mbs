<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ URL::asset('assets/admin_view/images/avatar.png') }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>
					@if( Auth::check() )
						{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
					@endif
				</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- sidebar menu -->
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			<li <?php if( isset($title) && $title == 'Dashboard' ) echo 'class="active"'; ?> >
				<a href="{{ route('user_dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
			</li>
			<li <?php if( isset($title) && $title == 'User prifile' ) echo 'class="active"'; ?> >
				<a href="{{ route('user_profile') }}"><i class="fa fa-user"></i> <span>Prifile</span></a>
			</li>
			<li <?php if( isset($title) && $title == 'Deposit money' ) echo 'class="active"'; ?> >
				<a href="{{ route('deposit') }}"><i class="fa fa-money"></i> <span>Deposit</span></a>
			</li>
			<li <?php if( isset($title) && $title == 'Fund Transfer' ) echo 'class="active"'; ?> >
				<a href="{{ route('fund_transfer') }}"><i class="fa fa-exchange"></i> <span>Fund Transfer</span></a>
			</li>
			<li <?php if( isset($title) && $title == 'Fund Withdraw' ) echo 'class="active"'; ?> >
				<a href="{{ route('fund_withdraw') }}"><i class="fa fa-university"></i> <span>Fund Withdraw</span></a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
	</aside>