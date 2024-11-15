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
                                <h5 class="m-b-10">Kategori Barang</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ url('kategori-brg') }}">Kategori Barang</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->

                <!-- [ TABEL KATEGORI ] start -->
                <div class="col-xl-12">
                    @if(session()->has('massage'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('massage') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif



                    <div class="card">
                        <div class="card-header">
                            <h5>Kategori Barang</h5>
                            <div class="card-header-right">
                                <a href="{{ url('tb_kategori') }}" type="button" class="btn btn-sm btn-success">Tambah Data</a>
                            </div>
                        </div> 

                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($posts as $index => $post)
                                        <tr>
                                            <td>
                                                {{ ($posts->currentPage()-1) * $posts->perPage() + $index + 1 }}
                                            </td>

                                            <td>{{ $post->nama_kategori }}</td>
                                            
                                            <td>
                                                <a href="{{ url('', $post->id) }}" type="button" class="btn btn-warning btn-sm">Edit</a>
                                                
                                                <a href="{{ url('', $post->id) }}" type="button" class="btn btn-danger btn-sm">Hapus</a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <ul class="pagination justify-content-end">
                                    @if ($posts->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $posts->previousPageUrl() }}">Previous</a></li>
                                    @endif
                                
                                    @foreach ($posts->links()->elements[0] as $page => $url)
                                        <li class="page-item {{ $posts->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                
                                    @if ($posts->hasMorePages())
                                        <li class="page-item"><a class="page-link" href="{{ $posts->nextPageUrl() }}">Next</a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                                    @endif
                                </ul>
                                

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
