@extends('layoutbootstrap')

@section('konten')

<!--  Main wrapper -->
<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                    <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                        <i class="ti ti-bell-ringing"></i>
                        <div class="notification bg-primary rounded-circle"></div>
                    </a>
                </li>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank"
                        class="btn btn-primary">Download Free</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35"
                                height="35" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">My Profile</p>
                                </a>
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-mail fs-6"></i>
                                    <p class="mb-0 fs-3">My Account</p>
                                </a>
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-list-check fs-6"></i>
                                    <p class="mb-0 fs-3">My Task</p>
                                </a>
                                <a href="{{ url('logout') }}"
                                    class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Data Produksi</h5>
                <!-- Display Error jika ada error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Akhir Display Error -->
                <!-- Awal Dari Input Form -->
                <form action="{{ route('produksi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="produksi_kode">Kode Produksi</label>
                        <input type="text" class="form-control" id="produksi_kode" name="produksi_kode" value="{{ $produksi->produksi_kode }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_produksi">Tanggal Produksi</label>
                        <input type="text" class="form-control" id="tanggal_produksi" name="tanggal_produksi" value="{{ $produksi->tanggal_produksi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="produk">Produk</label>
                        <div class="card-body">
                            <!-- Awal Dari Tabel -->
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Kuantitas</th>
                                            @if($produksi->status != 'approved')
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Kuantitas</th>
                                            @if($produksi->status != 'approved')
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($produk as $p)
                                            <tr>
                                                <td>{{ $p->produk_kode }}</td>
                                                <td>{{ $p->produk_nama }}</td>
                                                <td>{{ $p->produk_jenis }}</td>
                                                <td>{{ $p->kuantitas }}</td>
                                                <td>
                                                    <!-- Detail button -->
                                                    @if($produksi->status != 'approved')
                                                        <button type="button" onclick="deleteConfirm(this)"
                                                            data-id="{{ $p->id }}"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                        <!-- Delete button -->
                                                    @endif

                                                </td>                                                 
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Akhir Dari Tabel -->

                        </div>
                        @if($produksi->status != 'approved')
                            <a class="btn btn-success" href="{{ url('/produksi/create', $produksiId) }}" role="button">Tambah Produk</a>
                        @endif                       
                        <a class="btn btn-dark" href="{{ route('produksi.index') }}" role="button">Kembali</a>
                    </div>
                </form>
                <!-- Akhir Dari Input Form -->
            </div>
        </div>
    </div>

    <script>
        function deleteConfirm(e) {
            const id = e.getAttribute('data-id');
            const deleteUrl = `{{ url('produksidetail/destroy') }}/${id}`;
            const deleteButton = document.getElementById('btn-delete');

            deleteButton.setAttribute('href', deleteUrl);

            const message = `Data dengan ID <b>${id}</b> akan dihapus`;
            document.getElementById('xid').innerHTML = message;

            const myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                keyboard: false
            });

            myModal.show();
        }
    </script>

    <!-- Modal Delete Confirmation-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="xid"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection
