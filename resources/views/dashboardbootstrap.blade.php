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
        <!--  Row 1 -->
        <div class="card-body">
          <center>
          <img src="{{ asset ('images/logos/pecellele.jpg') }}" class="card-img-top" alt="..." style="width: 30%">  
          <hr />
        <h5 class="card-title">INILAH MENU TERBAIK KAMI</h5>
        <p class="card-text">Mari mencoba menu terbaik dari kami dan rasakan sensasi dan kepedasannya</p>
        <hr />
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card h-100">
              <img src="{{ asset ('images/logos/menuayam.jpg') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">AYAM GORENG</h5>
                <p class="card-text">Inilah Ayam goreng paling terenak didunia, rasanya yang gurih, crispy dan enak sekali akan membuat kamu makan berkali kali, mantap</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img src="{{ asset ('images/logos/menulele.jpg') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">LELE GORENG</h5>
                <p class="card-text">Inilah Lele goreng paling terenak didunia, rasanya yang gurih, crispy dan enak sekali akan membuat kamu makan berkali kali, mantap</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img src="{{ asset ('images/logos/menubebekk.jpg') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">BEBEK GORENG</h5>
                <p class="card-text">Inilah Bebek goreng paling terenak didunia, rasanya yang gurih, crispy dan enak sekali akan membuat kamu makan berkali kali, mantap</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img src="{{ asset ('images/logos/estehh.jpg') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">ES TEH MANIS</h5>
                <p class="card-text">Inilah Es Teh paling terenak didunia, rasanya yang gurih, crispy dan enak sekali akan membuat kamu makan berkali kali, mantap</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <img src="{{ asset ('images/logos/esjeruk.jpg') }}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">ES JERUK MANIS</h5>
                <p class="card-text">Inilah Es Jeruk paling terenak didunia, rasanya yang gurih, crispy dan enak sekali akan membuat kamu makan berkali kali, mantap</p>
              </div>
            </div>
          </div>
          <div class="col">
              <div class="card h-100">
                <img src="{{ asset ('images/logos/sogem.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">SODA GEMBIRA</h5>
                  <p class="card-text">Inilah Es Soda paling terenak didunia, rasanya yang gurih, crispy dan enak sekali akan membuat kamu makan berkali kali, mantap</p>
                </div>
              </div>
            </div>
        </div>
      </div>
      <center><hr />
      <div class="card-footer text-body-secondary">
        JEGLERRRR
      </div><hr />
    </div>
  @endsection
  