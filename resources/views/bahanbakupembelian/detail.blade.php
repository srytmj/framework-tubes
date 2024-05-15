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
                <h5 class="card-title fw-semibold mb-4">Data BahanbakuPembelian</h5>
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
                <form action="{{ route('bahanbakupembeliandetail.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="bahanbaku_pembelian_kode">Kode Bahan Baku Pembelian</label>
                        <input type="text" class="form-control" id="bahanbaku_pembelian_kode"
                            name="bahanbaku_pembelian_kode" value="{{ $bahanbakupembelian->bahanbaku_pembelian_kode }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="distributor">Distributor</label>
                        <input type="text" class="form-control" id="distributor" name="distributor_nama"
                            value="{{ $bahanbakupembelian->distributor_nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="bahanbaku">Bahan Baku</label>
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
                                            <th>Harga Satuan</th>
                                            <th>Subtotal</th>
                                            @if($bahanbakupembelian->status != 'approved')
                                                <th>Aksi</th>
                                            @endif                                        </tr>
                                    </thead>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Kuantitas</th>
                                            <th>Harga Satuan</th>
                                            <th>Subtotal</th>
                                            @if($bahanbakupembelian->status != 'approved')
                                                <th>Aksi</th>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="text-right">Total</th>
                                            <th id="totalSubtotal">Rp 0</th>
                                            @if($bahanbakupembelian->status != 'approved')
                                                <th></th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($bahanbaku as $p)
                                            <tr>
                                                <td>{{ $p->bahanbaku_kode }}</td>
                                                <td>{{ $p->bahanbaku_nama }}</td>
                                                <td>{{ $p->bahanbaku_jenis }}</td>
                                                <td>{{ $p->kuantitas }}</td>
                                                <td>{{ $p->harga_satuan }}</td>
                                                <td class="subtotal">{{ $p->subtotal }}</td>
                                                <td>
                                                    <!-- Detail button -->
                                                    @if($bahanbakupembelian->status != 'approved')
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
                        @if($bahanbakupembelian->status != 'approved')
                            <a class="btn btn-success" href="{{ url('/bahanbakupembeliandetail/create', $bahanbakupembelianId) }}" role="button">Tambah Bahan Baku</a>
                        @endif                       
                        <a class="btn btn-dark" href="{{ route('bahanbakupembelian.index') }}" role="button">Kembali</a>
                    </div>
                </form>
                <!-- Akhir Dari Input Form -->
            </div>
        </div>
    </div>

    <script>
        function deleteConfirm(e) {
            const id = e.getAttribute('data-id');
            const deleteUrl = `{{ url('bahanbakupembeliandetail/destroy') }}/${id}`;
            const deleteButton = document.getElementById('btn-delete');

            deleteButton.setAttribute('href', deleteUrl);

            const message = `Data dengan ID <b>${id}</b> akan dihapus`;
            document.getElementById('xid').innerHTML = message;

            const myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
                keyboard: false
            });

            myModal.show();
        }

        function formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(value);
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(function(subtotal) {
                total += parseFloat(subtotal.textContent) || 0;
                subtotal.textContent = formatRupiah(subtotal.textContent);
            });
            document.getElementById('totalSubtotal').textContent = formatRupiah(total);
        }

        document.addEventListener('DOMContentLoaded', function() {
            calculateTotal();
        });
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
