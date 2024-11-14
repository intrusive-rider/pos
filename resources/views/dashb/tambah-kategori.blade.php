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
                            <h5 class="m-b-10">Tambah Data Kategori</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ url('kategori-brg') }}">Kategori Barang</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('tb-kategori') }}">Tambah Data Kategori</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->

            <!-- [ TABEL KATEGORI ] start -->
            <div class="justify-content-center row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tambah Data Kategori</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" class="form-control" placeholder="Nama Kategori">
                                </div>

                                <button type="submit" class="btn  btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            



            <!-- [ TABEL KATEGORI ] end -->


            

        <!-- [ Main Content ] end -->

    </div>
</div>



   @include('dashb.js-end')

</body>

</html>
