

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
	
	
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ url('') }}" class="text-nowrap logo-img"><br />
            <img src="{{asset('images/logos/pecellelelogo.jpg')}}" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            
            @role('admin|manajer')
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Masterdata</span>
              </li>
             {{-- Masterdata --}}
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('coa') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-clipboard"></i>
                </span>
                <span class="hide-menu">Coa</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('jabatan') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-clipboard"></i>
                </span>
                <span class="hide-menu">Jabatan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('pegawai') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Pegawai</span>
              </a>
            </li>
            @endrole

            @role('admin')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('bahanbaku') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-diamond"></i>
                </span>
                <span class="hide-menu">Bahan Baku</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('distributor') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-map-pins"></i>
                </span>
                <span class="hide-menu">Distributor</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('produk') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-fish"></i>
                </span>
                <span class="hide-menu">Produk</span>
              </a>
            </li>
            @endrole
            

            @role('admin|manajer|petugas_gudang')
             {{-- Transaksi - Admin --}}
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Transaksi Admin</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('bahanbakupembelian') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-building"></i>
                </span>
                <span class="hide-menu">Pembelian Bahan Baku</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('produksi') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-clock-play"></i>
                </span>
                <span class="hide-menu">Produksi</span>
              </a>
            </li>
            @endrole

            @role('admin|manajer')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('pegawaipenggajian') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-premium-rights"></i>
                </span>
                <span class="hide-menu">Penggajian</span>
              </a>
            </li>
            @endrole

            {{-- Transaksi - Kasir --}}
            @role('admin|kasir|manajer')
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Transaksi Kasir</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('penjualan') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-shopping-cart"></i>
                </span>
                <span class="hide-menu">Penjualan</span>
              </a>
            </li>

            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('pembayaran/viewkeranjang') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-credit-card"></i>
                </span>
                <span class="hide-menu">Pembayaran</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('pembayaran/viewstatus') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-credit-card"></i>
                </span>
                <span class="hide-menu">Status Pembayaran</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('pembayaran/viewapprovalstatus') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-credit-card"></i>
                </span>
                <span class="hide-menu">Approval Pembayaran</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('midtrans') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-credit-card"></i>
                </span>
                <span class="hide-menu">Midtrans</span>
              </a>
            </li> --}}

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('midtrans/bayar') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-check"></i>
                </span>
                <span class="hide-menu">Pembayaran</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('pembayaran/viewstatusPG') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-checkup-list"></i>
                </span>
                <span class="hide-menu">Status Penjualan</span>
              </a>
            </li>
            @endrole

            
            {{-- Laporan --}}
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Laporan</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('jurnal/umum') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-files"></i>
                </span>
                <span class="hide-menu">Jurnal Umum</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('jurnal/bukubesar') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-archive"></i>
                </span>
                <span class="hide-menu">Buku Besar</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('api/berita') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-api-app"></i>
                </span>
                <span class="hide-menu">API Berita Produksi</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('api/berita1') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-api-app"></i>
                </span>
                <span class="hide-menu">API Berita Populasi</span>
              </a>
            </li>

            {{-- Grafik --}}
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Grafik</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('grafik/viewPenjualanBlnBerjalan') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-building-store"></i>
                </span>
                <span class="hide-menu">Penjualan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('grafik/viewJmlPenjualan') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-packages"></i>
                </span>
                <span class="hide-menu">Produk</span>
              </a>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('grafik/viewJmlProdukTerjual') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-package"></i>
                </span>
                <span class="hide-menu">Produk Per Bulan</span>
              </a>
            </li> --}}

            {{-- Analisis Data --}}
            {{-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">ANALISIS DATA</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Icons</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Sample Page</span>
              </a>
            </li> --}}

          </ul>
          
          <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
            <div class="d-flex">
              <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
                <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
              </div>
              <div class="unlimited-access-img">
                <img src="{{asset('images/backgrounds/rocket.png')}}" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->