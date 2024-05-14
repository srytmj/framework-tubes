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
                    <form action="{{ route('bahanbakupembelian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="bahanbaku_pembelian_kode">Kode Bahan Baku Pembelian</label>
                            <input type="text" class="form-control" id="bahanbaku_pembelian_kode"
                                name="bahanbaku_pembelian_kode" value="{{ $bahanbakuPembelian->bahanbaku_pembelian_kode }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="distributor">Distributor</label>
                            <input type="text" class="form-control" id="distributor" name="distributor_nama"
                                value="{{ $bahanbakuPembelian->distributor->distributor_nama }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="bahanbaku">Bahan Baku</label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Bahan Baku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bahanbakuPembelian->bahanBaku as $bahanBaku)
                                        <tr>
                                            <td>{{ $bahanBaku->bahanbaku_nama }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary">Ubah</button>
                                                <button type="button" class="btn btn-danger">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success">Tambah Data Bahan Baku</button>
                        </div>
                        <!-- untuk tombol simpan -->
                        <input class="btn btn-success" type="submit" value="Simpan">
                        <!-- untuk tombol batal simpan -->
                        <a class="btn btn-dark" href="{{ route('bahanbakupembelian.index') }}" role="button">Batal</a>
                    </form>
                    <!-- Akhir Dari Input Form -->

                </div>
            </div>
        </div>
    @endsection
