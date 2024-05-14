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
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{asset('images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
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
                    <a href="{{url('logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
            <h5 class="card-title fw-semibold mb-4">Data Pegawai</h5>

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
                <form action="{{ route('pegawai.store') }}" method="post">
                    @csrf
                    <fieldset disabled>
                        <div class="mb-3"><label for="pegawaiidlabel">Id Pegawai</label>
                        <input class="form-control form-control-solid" id="id_pegawai_tampil" name="id_pegawai_tampil" type="text" placeholder="Contoh: PGW-001" value="{{$pegawai_id}}" readonly></div>
                    </fieldset>
                    <input type="hidden" id="pegawai_id" name="pegawai_id" value="{{$pegawai_id}}">

                    <!-- Nama Pegawai -->
                    <div class="mb-3">
                        <label for="pegawai_nama" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control form-control-solid" id="pegawai_nama" name="pegawai_nama" placeholder="Contoh: John Doe" value="{{ old('pegawai_nama') }}">
                    </div>

                    <!-- Nomor Telepon Pegawai -->
                    <div class="mb-3">
                        <label for="pegawai_no_telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control form-control-solid" id="pegawai_no_telepon" name="pegawai_no_telepon" placeholder="Contoh: 081234567890" value="{{ old('pegawai_no_telepon') }}">
                    </div>

                    <!-- Alamat Pegawai -->
                    <div class="mb-3">
                        <label for="pegawai_alamat" class="form-label">Alamat Pegawai</label>
                        <textarea class="form-control form-control-solid" id="pegawai_alamat" name="pegawai_alamat" rows="3" placeholder="Contoh: Jl. Bunga Matahari No. 16">{{ old('pegawai_alamat') }}</textarea>
                    </div>

                    <!-- Jenis Kelamin Pegawai -->
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pegawai_jenis_kelamin" id="jenis_kelamin_l" value="L" {{ old('pegawai_jenis_kelamin') == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jenis_kelamin_l">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pegawai_jenis_kelamin" id="jenis_kelamin_p" value="P" {{ old('pegawai_jenis_kelamin') == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="jenis_kelamin_p">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <!-- Jabatan Pegawai -->
                    <div class="mb-3">
                      <label for="pegawai_jabatan" class="form-label">Jabatan Pegawai</label>
                      <select class="form-select form-select-solid" id="pegawai_jabatan" name="pegawai_jabatan">
                        <option value="">Pilih Jabatan</option>
                        <option value="Koki" {{ old('pegawai_jabatan') == 'Koki' ? 'selected' : '' }}>Koki</option>
                        <option value="Pelayan" {{ old('pegawai_jabatan') == 'Pelayan' ? 'selected' : '' }}>Pelayan</option>
                        <option value="Kasir" {{ old('pegawai_jabatan') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="Petugas Kebersihan" {{ old('pegawai_jabatan') == 'Petugas Kebersihan' ? 'selected' : '' }}>Petugas Kebersihan</option>
                        <option value="Manager" {{ old('pegawai_jabatan') == 'Manager' ? 'selected' : '' }}>Manager</option>
                      </select>
                    </div>
                    <!-- untuk tombol simpan -->
                    
                    <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">

                    <!-- untuk tombol batal simpan -->
                    <a class="col-sm-1 btn btn-dark  btn-sm" href="{{ url('/pegawai') }}" role="button">Batal</a>
                    
                </form>
                <!-- Akhir Dari Input Form -->
            
          </div>
        </div>
      </div>
		
		
		
        
@endsection