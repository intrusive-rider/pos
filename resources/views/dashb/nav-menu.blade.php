<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="User-Profile-Image">
                    <div class="user-details">
                        <span>John Doe</span>
                        <div id="more-details">UX Designer<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="{{ url('user-profile') }}"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
                        <li class="list-group-item"><a href="{{ url('auth-normal-sign-in') }}"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>

            
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>

                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                
                
                <li class="nav-item pcoded-hasmenu">
                    <a class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Master Data</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('kategori-brg') }}">Kategori</a></li>
                        <li><a href="{{ url('data-brg') }}">Barang</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('stok-brg') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Stok</span></a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('penjualan') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Penjualan</span></a>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Laporan</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ url('') }}">Laporan Harian</a></li>
                        <li><a href="{{ url('') }}">Laporan Bulanan</a></li>
                        <li><a href="{{ url('laporan-pb') }}">Laporan Pembayaran</a></li>
                    </ul>
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

            </ul>
            
        </div>
    </div>
</nav>
