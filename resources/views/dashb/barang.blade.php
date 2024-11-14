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
                            <h5 class="m-b-10">Data Barang</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ url('data-brg') }}">Data Barang</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->

             <!-- [ TABEL BARANG ] start -->
             <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Barang</h5>
                        <div class="card-header-right">
                            <a href="{{ url('/data-brg/tambah-barang') }}" type="button" class="btn btn-sm btn-success">Tambah Data</a>
                        </div>
                        
                    </div> 
                    
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori Barang</th>
                                        <th>Ukuran</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Baju muslim</td>
                                        <td>Baju</td>
                                        <td>S</td>
                                        <td>Rp.150,000</td>
                                        <td>foto</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <ul class="pagination justify-content-end">
								<li class="page-item disabled"><span class="page-link">Previous</span></li>
								<li class="page-item"><a class="page-link" href="#!">1</a></li>
								<li class="page-item active"><span class="page-link">2<span class="sr-only">(current)</span></span>
								</li>
								<li class="page-item"><a class="page-link" href="#!">3</a></li>
								<li class="page-item"><a class="page-link" href="#!">Next</a></li>
							</ul>

                        </div>
                    </div>
                </div>
            </div>
            <!-- [ TABEL BARANG ] end -->


            

        <!-- [ Main Content ] end -->

    </div>
</div>



   @include('dashb.js-end')

</body>

</html>
