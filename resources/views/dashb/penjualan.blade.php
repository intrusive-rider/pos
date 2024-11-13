<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashb.head')
</head>


<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
    

	<!-- [ navigation menu ] start -->
	@include('dashb.nav-menu')
	<!-- [ navigation menu ] end -->
	
    
    
    <!-- [ Header ] start -->
	@include('dashb.header')
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Penjualan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ url('penjualan') }}">Penjualan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
            <div class="row">

                



                {{-- [TABEL LIST STOK BARANG] start --}}
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header">
                            <h5>List Stok Barang</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label" for="Email">Email address</label>
                                            <input type="email" class="form-control" id="Email" aria-describedby="emailHelp" value="123">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label" for="Text">Text</label>
                                            <input type="text" class="form-control" id="Text" placeholder="123">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="floating-label" for="password">password</label>
                                            <input type="password" class="form-control" id="password" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- [TABEL LIST STOK BARANG] start --}}


                <!-- [ TABEL KASIR ] start -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h5>Kasir</h5>
                            <span class="d-block m-t-5">use class <code>table-hover</code> inside table element</span>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ TABEL KASIR ] end -->
            

            </div>
        <!-- [ Main Content ] end -->

    </div>
</div>



   @include('dashb.js-end')

</body>

</html>
