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
                    <h5 class="card-title fw-semibold mb-4">Data Bahan Baku</h5>

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
                    <form action="{{ route('bahanbaku.update', $bahanbaku->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset disabled>
                            <div class="mb-3"><label for="kodebahanbakulabel">Kode bahanbaku</label>
                                <input class="form-control form-control-solid" id="bahanbaku_kode_tampil"
                                    name="bahanbaku_kode_tampil" type="text" value="{{ $bahanbaku->bahanbaku_kode }}"
                                    readonly>
                            </div>
                        </fieldset>
                        <input type="hidden" id="bahanbaku_kode" name="bahanbaku_kode" jenis="bahanbaku_jenis"
                            value="{{ $bahanbaku->bahanbaku_kode }}">

                        <div class="mb-3"><label for="namabahanbakulabel">Nama bahanbaku</label>
                            <input class="form-control form-control-solid" id="bahanbaku_nama" name="bahanbaku_nama"
                                type="text" placeholder="Contoh: ayam goreng" value="{{ $bahanbaku->bahanbaku_nama }}">
                        </div>
                        <div class="mb-3">
                            <label for="jenisbahanbakulabel">Jenis bahanbaku</label>
                            <select class="form-control form-control-solid" id="bahanbaku_jenis" name="bahanbaku_jenis">
                                <option value="Daging/ Jeroan"
                                    {{ old('bahanbaku_jenis') == 'Daging/ Jeroan' ? 'selected' : '' }}>Daging/ Jeroan
                                </option>
                                <option value="Protein Nabati"
                                    {{ old('bahanbaku_jenis') == 'Protein Nabati' ? 'selected' : '' }}>Protein Nabati
                                </option>
                                <option value="Bumbu" {{ old('bahanbaku_jenis') == 'Bumbu' ? 'selected' : '' }}>Bumbu
                                </option>
                                <option value="Bahan Pokok"
                                    {{ old('bahanbaku_jenis') == 'Bahan Pokok' ? 'selected' : '' }}>Bahan Pokok</option>
                                <option value="Sayur" {{ old('bahanbaku_jenis') == 'Sayur' ? 'selected' : '' }}>Sayur
                                </option>
                                <option value="Bahan Pendukung"
                                    {{ old('bahanbaku_jenis') == 'Bahan Pendukung' ? 'selected' : '' }}>Bahan Pendukung
                                </option>
                                <option value="Minuman" {{ old('bahanbaku_jenis') == 'Minuman' ? 'selected' : '' }}>Minuman
                                </option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="jenisbahanbakulabel">Satuan Bahan Baku</label>
                            <select class="form-control form-control-solid" id="bahanbaku_satuan" name="bahanbaku_satuan">
                                <option value="kg" {{ old('bahanbaku_satuan') == 'kg' ? 'selected' : '' }}>Kilo Gram
                                </option>
                                <option value="gr" {{ old('bahanbaku_satuan') == 'gr' ? 'selected' : '' }}>Gram
                                </option>
                                <option value="pcs" {{ old('bahanbaku_satuan') == 'pcs' ? 'selected' : '' }}>Pieces
                                </option>
                                <option value="ml" {{ old('bahanbaku_satuan') == 'ml' ? 'selected' : '' }}>Mili Liter
                                </option>
                            </select>
                        </div>

                </div>


                <!-- untuk tombol simpan -->

                <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                <!-- untuk tombol batal simpan -->
                <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/bahanbaku') }}" role="button">Batal</a>

                </form>
                <!-- Akhir Dari Input Form -->

            </div>
        </div>
    </div>




@endsection
