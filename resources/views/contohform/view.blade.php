@extends('layoutbootstrap')

@section('konten')

<!-- Sweet Alert -->
@if(isset($status_hapus))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Hapus Data Berhasil',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        </script>
@endif

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
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h5 class="card-title fw-semibold mb-4">Contoh Berbagai Input Form</h5>
                  <div class="card">

                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Master Data Contoh Form</h6>
                            
                            <!-- Tombol Tambah Data -->
                            <a href="#" class="btn btn-primary btn-icon-split btn-sm tampilmodaltambah" data-toogle="modal" data-target="#ubahModal">
                                <span class="icon text-white-50">
                                    <i class="ti ti-plus"></i>
                                </span>
                                <span class="text">Tambah Data</span>
                            </a>
                            <!-- Akghir Tombol Tambah Data -->

                        </div>

                    <div class="card-body" id="show_all_contohform">
                      
                    </div>

                  </div>
                </div>
                
                
              </div>
            </div>
          </div>
        </div>

    <!-- Awal Function Delete Confirm -->
    <script>
        function deleteConfirm(e){
            var tomboldelete = document.getElementById('btn-delete')  
            id = e.getAttribute('data-id');

            // const str = 'Hello' + id + 'World';
            var url3 = "{{url('contohform/destroy/')}}";
            var url4 = url3.concat("/",id);
            // console.log(url4);

            // console.log(id);
            tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

            var pesan = "Data dengan ID <b>"
            var pesan2 = " </b>akan dihapus"
            var res = id;
            document.getElementById("xid").innerHTML = pesan.concat(res,pesan2);

            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {  keyboard: false });
            
            myModal.show();
        
        }
    </script>
    <!-- Akhir Function Delete Confirm -->
    <!-- Modal Delete Confirmation-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
            </div>
            <div class="modal-body" id="xid"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
                
            </div>
            </div>
        </div>
    </div>   
    <!-- Akhir Modal Delete Confirmation -->


    <!-- Ubah dan Tambah Data Menggunakan Modal -->
    <div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelmodalubah">Ubah Data Contoh Form</h5>
            </div>
            
            <form action="{{url('contohform')}}" class="formubah" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <!-- Form untuk input -->
                @csrf
                <input type="hidden" id="idcontohformhidden" name="idcontohformhidden" value="">
                <input type="hidden" id="tipeproses" name="tipeproses" value="tambah">
                <input type="hidden" id="namadokumenlama" name="namadokumenlama" value="">
                    <div class="mb-3 row">
                        <label for="nomerlabel" class="col-sm-4 col-form-label">Nama Dokumen</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" placeholder="Masukkan Nama Dokumen">
                            <div class="invalid-feedback errornama_dokumen"></div>
                        </div> 
                    </div>
                    <!-- Tempat untuk menampilkan gambar yang lama -->
                    <div class="mb-3 row">
                        <div class="col-sm-4" id="avatar" name="avatar">
                            <!-- <img src="http://127.0.0.1:8000/gambar/1664705125.jpg" width="150px" height="100px" alt=""> -->
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nomerlabel" class="col-sm-4 col-form-label">Gambar Dokumen</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="gambar_dokumen" name="gambar_dokumen" required>
                            <div class="invalid-feedback errorgambar_dokumen"></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="lantailabel" class="col-sm-4 col-form-label">Tgl Rilis</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_rilis" name="tgl_rilis" placeholder="Masukkan Nama Akun, cth: Kas">
                            <div class="invalid-feedback errortgl_rilis"></div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="hargalabel" class="col-sm-4 col-form-label">Klasifikasi</label>
                        <div class="col-sm-8">
                            <!-- Radio Button -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="klasifikasi_dokumen" id="klasifikasi_dokumen" value="internal">
                                <label class="form-check-label" for="flexRadioInternal">
                                    Internal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="klasifikasi_dokumen" id="klasifikasi_dokumen" value="eksternal">
                                <label class="form-check-label" for="flexRadioEksternal">
                                    Eksternal
                                </label>
                            </div>
                            <!--  -->
                        </div>
                    </div>

                    <!-- select2 -->
                    <div class="mb-3 row">
                        <label for="jenisdokumen" class="col-sm-4 col-form-label">Jenis Dokumen</label>
                        <div class="col-sm-8">
                            <select id="jenis_dok" name="jenis_dok[]" class="js-example-basic-multiple" multiple="multiple" style="width:300px">
                            <!-- <select id="jenis_dok" name="jenis_dok" class="form-control" style="width:300px"> -->
                                <option value="Aturan">Aturan</option>
                                <option value="Kebijakan">Kebijakan</option>
                                <option value="SK">SK</option>
                            </select>
                            <div class="invalid-feedback errorjenis_dok"></div>
                        </div>
                    </div>
                    <!-- akhir select2 -->

                    <!-- Check Box -->
                    <div class="mb-3 row">
                        <label for="hargalabel" class="col-sm-4 col-form-label">Hobi</label>
                        <div class="col-sm-8">
                            <!-- Check Button -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Renang" id="renang" name="renang">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Renang
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Musik" id="musik" name="musik">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Musik
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Tidur" id="tidur" name="tidur">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Tidur
                                </label>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                    <!-- Akhir Check Box -->

                </div>    

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>   
    <!-- Akhir Ubah dan Tambah Data Menggunakan Modal -->

    <!-- Ketika tombol dengan elemen id tampilmodaltambah ditekan -->
    <script>
          $(function(){
                $('.tampilmodaltambah').on('click', function(){
                  // merubah label menjadi Tambah Data Kamar
                  $('#labelmodalubah').html('Tambah Data Contoh Form');

                // required gambar dihilangkan
                let gbr = document.getElementById('gambar_dokumen');
                gbr.setAttribute("required", "");

                // centang di checkbox dihilangkan
                document.getElementById("renang").checked = false;
                document.getElementById("musik").checked = false;
                document.getElementById("tidur").checked = false;

                  url = "{{url('contohform')}}";
                //   $('.formubah').attr('action',url);

                // sebelum menambahkan tag img di dalam container div avatar, dihapus dulu sisa tag yg lama
                var parent = document.querySelector('#avatar');
                if (parent.hasChildNodes()) {
                    // It has at least one chile, remove it
                    parent.removeChild(parent.lastChild);
                }

                  // kosongkan isi dari input form
                  $('#nama_dokumen').val('');
                  $('#tgl_rilis').val('');
                  $("#avatar").html('');
                  $('#renang').attr("checked",false);  
                  $('#tidur').attr("checked",false);  
                  $('#musik').attr("checked",false);  
                  $('#klasifikasi_dokumen').attr("checked",false);  
                  $('#idcontohformhidden').val('');
                  $('#tipeproses').val('tambah'); //untuk identifikasi di controller apakah tambah atau update


                    var data = {
                        'nama_dokumen': $('.nama_dokumen').val(),
                        'gambar_dokumen': $('.gambar_dokumen').val(),
                        'tgl_rilis': $('.tgl_rilis').val(),
                        'klasifikasi_dokumen': $('.klasifikasi_dokumen').val(),
                    }  
                    // console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                  $('#ubahModal').modal('show');
                  
                //   const id = $(this).data('id');
                  $.ajax(
                    {
                      
                        type: "post", //isinya put untuk update dan post untuk insert
                        url: "{{url('contohform')}}",
                        data: data,
                        dataType: "json",
                        success: function (response) {
                            // console.log(response);
                            // console.log(data);
                        }

                    }
                  ); 

                });
              }); 
    </script>
    <!-- Akhir Jquery Proses Ubah / Tambah Data -->

    <!-- Ketika tombol dengan elemen class bernama  editbtn ditekan -->
    <script>
          function updateConfirm(e){
            id = e.getAttribute('data-id');

            $('#labelmodalubah').html('Ubah Data Contoh Form');
            url = "{{url('contohform')}}";
            // $('.formubah').attr('action',url);
            $('#idcontohformhidden').val(id);
            $('#tipeproses').val('ubah'); 

            // required gambar dihilangkan
            let gbr = document.getElementById('gambar_dokumen');
            gbr.removeAttribute('required');

            $('#ubahModal').modal('show');

            var url3 = "{{url('contohform/edit/')}}";
            var url4 = url3.concat("/",id);

            // id dari tag img adalag x-id
            var identifierxid = "x-"+id;
            var dapatkantagimg = document.getElementById(identifierxid).src;
            // console.log(dapatkantagimg);
            // dapatkan posisi karakter dari "/" terakhir dari http://127.0.0.1:8000/gambar/1664705125.jpg
            var n = dapatkantagimg.lastIndexOf("/")
            var res = dapatkantagimg.substring(n+1); //mendapatkan nama file gambar lama dari db 1664705125.jpg
            // console.log(res);

            // sebelum menambahkan tag img di dalam container div avatar, dihapus dulu sisa tag yg lama
            var parent = document.querySelector('#avatar');
            if (parent.hasChildNodes()) {
                // It has at least one chile, remove it
                parent.removeChild(parent.lastChild);
            }
          

            // menambahkan img
            const image = document.createElement('img')
            var urlgambar = "{{url('gambar/')}}";
            var urlgambarfix = urlgambar.concat("/",res); //menggabungkan url dengan data nama file
            image.src = urlgambarfix
            image.width = "150";
            image.height = "100";
            document.querySelector('#avatar').appendChild(image);

            $.ajax({
                type: "GET",
                url: url4,
                success: function (response) {
                    // console.log(response);
                    if (response.status == 404) {
                        // beri alert kalau gagal
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.message,
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                        });

                        $('#ubahModal').modal('hide');
                    } else {
                        // console.log(response);
                        $('#nama_dokumen').val(response.c[0].nama_dokumen);
                        // $('#nama_dokumen').val(response.c.nama_dokumen);
                        // $('#gambar_dokumen').val(response.c.gambar_dokumen);
                        $('#tgl_rilis').val(response.c[0].tgl_rilis);
                        // $('#klasifikasi_dokumen').val(response.c.klasifikasi_dokumen);

                        // cek jika klasifikasi dokumen adalah dokumen eksternel maka nilai chekced elemen radio buttonnya di buat true
                        if(response.c[0].klasifikasi_dokumen==='eksternal'){
                            document.querySelector('input[name=klasifikasi_dokumen][value=eksternal]').checked = true;
                        }else{
                            document.querySelector('input[name=klasifikasi_dokumen][value=internal]').checked = true;
                        }
                        
                        $('#namadokumenlama').val(response.c[0].gambar_dokumen);

                        // update confirm
                        // console.log(response.c[0].list_dokumen);
                        // split nilai
                        var text = response.c[0].list_dokumen;
                        var myArray = text.split(",");
                        $('#jenis_dok').val(myArray); // Select the option with a value of '1'
                        $('#jenis_dok').trigger('change'); // Notify any JS components that the value changed

                        // centang di checkbox dihilangkan
                        var text = response.c[0].list_hobi;
                        console.log(text);
                        var myArray = text.split(",");
                        document.getElementById("renang").checked = false;
                        document.getElementById("musik").checked = false;
                        document.getElementById("tidur").checked = false;
                        for (let i = 0; i < myArray.length; i++) {
                            // berikan nilai true pada atribut checked
                            document.getElementById(myArray[i].toLowerCase()).checked = true;
                        }
                        
                    }
                }
            });
          } 
    </script>
    <!-- Akhir Ketika tombol dengan elemen class bernama  editbtn ditekan -->


    <!-- Proses mengisi data pada tabel -->
    <script>
            function datacontohform(){
                $.ajax({
                    url: '{{ url('contohform/fetchAll') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_all_contohform").html(response);
                        $("table").DataTable({
                        order: [0, 'desc']
                        });
                    }
                });
            }
            
        </script>
        <script>
            $(document).ready(function(){
                datacontohform();
                }
            );
        </script>
    <!-- Akhir mengisi data pada tabel -->


        <!-- Ketika tombol submit di form ditekan -->
        <script>

        // definisikan tipe method yang berbeda 
        // untuk update=>put (pembedanga adalah inner html pada labelmodalubah berisi Ubah Data Coa)
        // sedangkan untuk input=>post nilai inner html pada labelmodalubah berisi Tambah Data Coa


        $(document).ready(function()
            {   		
                $('.formubah').submit(function(e)
                    {
                        e.preventDefault();
                        const fd = new FormData(this);
                        // console.log(fd);
                            $.ajax(
                                {
                                    type: "post", //isinya post untuk insert dan put untuk delete
                                    url: $(this).attr('action'),
                                    //data: $(this).serialize(),
                                    data: fd,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    dataType: "json",
                                    success: function (response){
                                        console.log(response);
                                        // jika responsenya adalah error
                                        if (response.status == 400) {
                                            if(response.errors.nama_dokumen){
                                                $('#nama_dokumen').removeClass('is-valid').addClass('is-invalid');
                                                $('.errornama_dokumen').html(response.errors.nama_dokumen);
                                            }else{
                                                $('#nama_dokumen').removeClass('is-invalid').addClass('is-valid');
                                                $('.errornama_dokumen').html();
                                            }

                                            if(response.errors.gambar_dokumen){
                                                $('#gambar_dokumen').removeClass('is-valid').addClass('is-invalid');
                                                $('.errorgambar_dokumen').html(response.errors.gambar_dokumen);
                                            }else{
                                                $('#gambar_dokumen').removeClass('is-valid').removeClass('is-invalid').addClass('is-valid');
                                                $('.errorgambar_dokumen').html();
                                            }

                                            if(response.errors.tgl_rilis){
                                                $('#tgl_rilis').removeClass('is-valid').addClass('is-invalid');
                                                $('.errortgl_rilis').html(response.errors.tgl_rilis);
                                            }else{
                                                $('#tgl_rilis').removeClass('is-invalid').addClass('is-valid');
                                                $('.errortgl_rilis').html();
                                            }

                                            if(response.errors.klasifikasi_dokumen){
                                                $('#klasifikasi_dokumen').removeClass('is-valid').addClass('is-invalid');
                                                $('.errorklasifikasi_dokumen').html(response.errors.klasifikasi_dokumen);
                                            }else{
                                                $('#klasifikasi_dokumen').removeClass('is-invalid').addClass('is-valid');
                                                $('.errorklasifikasi_dokumen').html();
                                            }

                                        }
                                        else{
                                            // munculkan pesan sukses
                                            Swal.fire({
                                                title: 'Berhasil!',
                                                text: response.sukses,
                                                icon: 'success',
                                                confirmButtonText: 'Ok'
                                            });
                                            
                                            // kosongkan form
                                            $('#ubahModal').modal('hide');
                                            datacontohform(); //refresh data coa

                                        }
                                    },
                                    error: function(xhr, ajaxOptions, thrownError){
                                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                    } 
                                } 
                            );
                            return false;
                    }
                );
            }
        );
        </script>
        <!-- Akhir ketika tombol submit di form ditekan -->

@endsection