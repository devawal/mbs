<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('user_dashboard') }}" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>M</b>BS</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Mini Bank </b>System</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
      	<div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              	<!-- User Account: style can be found in dropdown.less -->
              	<li class="dropdown user user-menu">
	                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ URL::asset('assets/admin_view/images/avatar.png') }}" class="user-image" alt="User Image">
						<span class="hidden-xs">
							@if( Auth::check() )
								{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
							@endif
						</span>
	                </a>
	                <ul class="dropdown-menu">
	                  	<!-- User image -->
						<li class="user-header">
							<img src='{{ URL::asset("assets/admin_view/images/avatar.png") }}' width="215" class="img-circle" alt="User Image">
							<p>
								@if( Auth::check() )
									{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
									<small>Member since {{ date('M Y', strtotime(Auth::user()->created_at)) }}</small>
								@endif
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="{{ route('user_profile') }}" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="{{ route('get_logout') }}" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
	                </ul>
              	</li>
            </ul>
      	</div>
    </nav>
</header>