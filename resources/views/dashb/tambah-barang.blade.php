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
                            <h5 class="m-b-10">Tambah Data Barang</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ url('data-brg') }}">Data Barang</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('tambah-barang') }}">Tambah Data Barang</a></li>
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
                            <h5>Tambah Data Barang</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <input type="text" class="form-control" aria-label="nama barang" aria-describedby="inputGroup-sizing-sm"placeholder="nama barang">
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">logo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Kategori</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <select class="custom-select" id="inputGroupSelect02">
                                            <option selected>Pilih Kategori</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">logo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Ukuran</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <select class="custom-select" id="inputGroupSelect02">
                                            <option selected>Pilih Ukuran</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">logo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Harga</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <input type="text" class="form-control" aria-label="harga barang" aria-describedby="inputGroup-sizing-sm"placeholder="harga barang">
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="inputGroupSelect02">logo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile02">
                                            <label class="custom-file-label" for="inputGroupFile02">Pilih Foto</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">logo</span>
                                        </div>
                                    </div>
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
