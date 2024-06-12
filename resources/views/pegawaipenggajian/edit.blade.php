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
                    <h5 class="card-title fw-semibold mb-4">Data Penggajian {{$pegawai_nama}} {{ $pegawaipenggajian->periode }}</h5>

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

                    <!-- Display Error jika data sudah ada pada periode yang sama -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Akhir Display Error -->
                    
                    <form action="{{ route('pegawaipenggajian.update', $pegawaipenggajian->id) }}" method="post">
                        @csrf
                        @method('PUT')
                    
                        <!-- Bulan dan Tahun -->
                        <div class="mb-3" hidden>
                            <label for="periode" class="form-label">Periode</label>
                            <input type="month" class="form-control form-control-solid" id="periode" name="periode"
                                value="{{ old('periode', $pegawaipenggajian->periode) }}">
                        </div>

                        <input id="periode" name="periode" value="{{ old('periode', $pegawaipenggajian->periode) }}" hidden>
                    
                        <!-- Nama Pegawai -->
                        <div class="mb-3" hidden>
                            <label for="pegawai_ids" class="form-label">Nama Pegawai</label>
                            <select class="form-select form-select-solid" id="pegawai_ids" name="pegawai_ids" onchange="updateJabatan()">
                                <!-- Placeholder -->
                                <option value="" selected disabled>Select Pegawai</option>
                                @foreach ($pegawai as $p)
                                    <option value="{{ $p->pegawai_id }}|{{ $p->pegawai_jabatan }}" {{ $p->pegawai_id == $pegawaipenggajian->pegawai_id ? 'selected' : '' }}>
                                        {{ $p->pegawai_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <!-- Jabatan Pegawai -->
                        <div class="mb-3">
                            <label for="pegawai_jabatan" class="form-label">Jabatan Pegawai</label>
                            <input type="text" class="form-control form-control-solid" id="pegawai_jabatan" name="pegawai_jabatan"
                                value="{{ old('pegawai_jabatan', $pegawaipenggajian->pegawai_jabatan) }}" readonly>
                        </div>
                    
                        <!-- pegawai_id -->
                        <div class="mb-3" hidden>
                            <label for="pegawai_id" class="form-label">pegawai_id</label>
                            <input type="text" class="form-control form-control-solid" id="pegawai_id" name="pegawai_id"
                                value="{{ old('pegawai_id', $pegawaipenggajian->pegawai_id) }}" readonly>
                        </div>
                    
                        <!-- Jam Kerja -->
                        <div class="mb-3">
                            <label for="jam_kerja" class="form-label">Jam Kerja</label>
                            <input type="number" class="form-control form-control-solid" id="jam_kerja" name="jam_kerja"
                                value="{{ old('jam_kerja', $pegawaipenggajian->jam_kerja) }}" onchange="calculateGaji()">
                        </div>
                    
                        <!-- Gaji -->
                        <div class="mb-3">
                            <label for="gaji" class="form-label">Gaji</label>
                            <input type="text" class="form-control form-control-solid" id="gaji" name="gaji"
                                value="{{ old('gaji', $pegawaipenggajian->gaji) }}" readonly>
                        </div>
                    
                        <script>
                            // Simulasi data gaji per jam berdasarkan jabatan
                            const gajiPerJam = {
                                'Koki': 50000,
                                'Pelayan': 40000,
                                'Kasir': 30000,
                                'Petugas Kebersihan': 20000,
                                'Manager': 100000,
                                // tambahkan jabatan dan gaji per jam sesuai kebutuhan
                            };
                    
                            function updateJabatan() {
                                var select = document.getElementById("pegawai_ids");
                                var selectedValue = select.options[select.selectedIndex].value;
                                var [pegawaiId, pegawaiJabatan] = selectedValue.split('|');
                                document.getElementById("pegawai_jabatan").value = pegawaiJabatan;
                                document.getElementById("pegawai_id").value = pegawaiId; // Tambahan ini untuk mengisi pegawai_id
                                // Hitung gaji setelah mengupdate jabatan
                                calculateGaji();
                            }
                    
                            function calculateGaji() {
                                var pegawaiJabatan = document.getElementById("pegawai_jabatan").value;
                                var jamKerja = document.getElementById("jam_kerja").value;
                    
                                if (pegawaiJabatan && jamKerja) {
                                    var gaji = gajiPerJam[pegawaiJabatan] * jamKerja;
                                    document.getElementById("gaji").value = gaji;
                                } else {
                                    document.getElementById("gaji").value = '';
                                }
                            }
                    
                            // Panggil updateJabatan saat halaman dimuat ulang untuk memastikan nilai jabatan dan gaji terisi
                            document.addEventListener('DOMContentLoaded', function() {
                                updateJabatan();
                            });
                        </script>
                    
                        <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">
                    
                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ route('pegawaipenggajian.index') }}" role="button">Batal</a>
                    </form>
                    

                </div>
            </div>
        </div>




    @endsection
