<ul class="nav pcoded-inner-navbar {{ $layouts == 'horizontal' ? 'sidenav-inner' : '' }}">
	<li class="nav-item pcoded-menu-caption">
		<label>Navigation</label>
	</li>
	<li class="nav-item">
		<a href="{{ url('dashb.home') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
	</li>
	<li class="nav-item pcoded-hasmenu">
		<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Page layouts</span></a>
		<ul class="pcoded-submenu">
			<li><a href="{{ url('layout-vertical') }}" target="_blank">Vertical</a></li>
			<li><a href="{{ url('layout-horizontal') }}" target="_blank">Horizontal</a></li>
		</ul>
	</li>
	<li class="nav-item pcoded-menu-caption">
		<label>UI Element</label>
	</li>
	<li class="nav-item pcoded-hasmenu">
		<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Basic</span></a>
		<ul class="pcoded-submenu">
			<li><a href="{{ url('bc_alert') }}">Alert</a></li>
			<li><a href="{{ url('bc_button') }}">Button</a></li>
			<li><a href="{{ url('bc_badges') }}">Badges</a></li>
			<li><a href="{{ url('bc_breadcrumb-pagination') }}">Breadcrumb & paggination</a></li>
			<li><a href="{{ url('bc_card') }}">Cards</a></li>
			<li><a href="{{ url('bc_collapse') }}">Collapse</a></li>
			<li><a href="{{ url('bc_carousel') }}">Carousel</a></li>
			<li><a href="{{ url('bc_grid') }}">Grid system</a></li>
			<li><a href="{{ url('bc_progress') }}">Progress</a></li>
			<li><a href="{{ url('bc_modal') }}">Modal</a></li>
			<li><a href="{{ url('bc_spinner') }}">Spinner</a></li>
			<li><a href="{{ url('bc_tabs') }}">Tabs & pills</a></li>
			<li><a href="{{ url('bc_typography') }}">Typography</a></li>
			<li><a href="{{ url('bc_tooltip-popover') }}">Tooltip & popovers</a></li>
			<li><a href="{{ url('bc_toasts') }}">Toasts</a></li>
			<li><a href="{{ url('bc_extra') }}">Other</a></li>
		</ul>
	</li>
	<li class="nav-item pcoded-menu-caption">
		<label>Forms &amp; table</label>
	</li>
	<li class="nav-item">
		<a href="{{ url('form_elements') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Forms</span></a>
	</li>
	<li class="nav-item">
		<a href="{{ url('tbl_bootstrap') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Bootstrap table</span></a>
	</li>
	<li class="nav-item pcoded-menu-caption">
		<label>Chart & Maps</label>
	</li>
	<li class="nav-item">
		<a href="{{ url('chart-apex') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Chart</span></a>
	</li>
	<li class="nav-item">
		<a href="{{ url('map-google') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Maps</span></a>
	</li>
	<li class="nav-item pcoded-menu-caption">
		<label>Pages</label>
	</li>
	<li class="nav-item pcoded-hasmenu">
		<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
		<ul class="pcoded-submenu">
			<li><a href="{{ url('auth-signup') }}" target="_blank">Sign up</a></li>
			<li><a href="{{ url('auth-signin') }}" target="_blank">Sign in</a></li>
		</ul>
	</li>
	<li class="nav-item"><a href="{{ url('sample-page') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li>
</ul>
