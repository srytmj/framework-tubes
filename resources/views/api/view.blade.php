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
                                    <a href="./authentication-login.html"
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
            <div class="container-fluid">
                <div class="card-body">
                    <center>
                        <img src="{{ asset('images/logos/pecellele.jpg') }}" class="card-img-top" alt="..."
                            style="width: 30%">
                        <hr />
                        <h5 class="card-title">BERITA SEPUTAR PANGAN</h5>
                        <p class="card-text">JUMLAH PRODUKSI DAGING DI KOTA BANDUNG</p>
                        <hr />
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach ($data as $d)
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $d['kategori_hewan_ternak'] }}</h5>
                                            <p class="card-text">Data Pada Provinsi {{ $d['nama_provinsi'] }}</p>
                                            <p class="card-text">Data Pada Kota {{ $d['bps_nama_kabupaten_kota'] }} Tahun
                                                {{ $d['tahun'] }}</p>
                                            <p class="card-text">Jumlah Produksi
                                                {{ number_format($d['jumlah_produksi_daging'], 2) }} {{ $d['satuan'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <center>
                            <hr />
                            <div class="card-footer text-body-secondary">
                                JEGLERRRR
                            </div>
                            <hr />
                </div>
            </div>


            <script>
                function deleteConfirm(e) {
                    var tomboldelete = document.getElementById('btn-delete')
                    id = e.getAttribute('data-id');

                    var url3 = "{{ url('bahanbaku/destroy/') }}";
                    var url4 = url3.concat("/", id);

                    tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

                    var pesan = "Data dengan ID <b>"
                    var pesan2 = " </b>akan dihapus"
                    var res = id;
                    document.getElementById("xid").innerHTML = pesan.concat(res, pesan2);

                    var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
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
                                x
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
