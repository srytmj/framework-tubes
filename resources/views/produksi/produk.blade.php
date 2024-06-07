@extends('layoutbootstrap')

@section('konten')
    <div class="body-wrapper">
        <header class="app-header">
            <!-- Header content -->
        </header>

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Awal Dari Tabel -->
                    <h5 class="card-title fw-semibold mt-5">Produk Yang Siap Dibuat</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $item)
                                    <tr>
                                        <td>{{ $item->produk_nama }}</td>
                                        <td>{{ $item->produk_jenis }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Akhir Dari Tabel -->

                    <form action="{{ route('produksidetail.store') }}" method="post">
                        @csrf

                        <!-- Hidden produksi_kode -->
                        <input type="" id="produksi_kode" name="produksi_kode" value="{{ $ProduksiKode }}" hidden>

                        <!-- Hidden produksi_id -->
                        <input type="" id="produksi_id" name="produksi_id" value="{{ $ProduksiId }}" hidden>

                        <div class="mb-3">
                            <label for="produk_jenis">Jenis produk</label>
                            <select class="form-control form-control-solid" id="produk_jenis" name="produk_jenis" required>
                                <option value="">Pilih Jenis Produk</option>
                                @foreach ($produkJenisList as $jenis)
                                    <option value="{{ $jenis->produk_jenis }}"
                                        {{ old('produk_jenis') == $jenis->produk_jenis ? 'selected' : '' }}>
                                        {{ $jenis->produk_jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="produk_nama">Nama Produk</label>
                            <select class="form-control form-control-solid" id="produk_nama" name="produk_kode" required>
                                <option value="">Pilih Nama Produk</option>
                                <!-- Nama produk akan diisi secara dinamis -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kuantitas">Kuantitas</label>
                            <input class="form-control form-control-solid" id="kuantitas" name="kuantitas" type="number"
                                placeholder="Masukkan Kuantitas" value="{{ old('kuantitas') }}" required>
                        </div>

                        <input class="col-sm-1 btn btn-success btn-sm" type="submit" value="Simpan">
                        <a class="col-sm-1 btn btn-dark btn-sm" href="javascript:history.back()" role="button">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#produk_jenis').change(function() {
                let jenis = $(this).val();
                let namaProdukDropdown = $('#produk_nama');

                namaProdukDropdown.empty();

                if (jenis) {
                    $.get("{{ route('getProdukByJenis') }}", {
                        jenis: jenis
                    }, function(data) {
                        console.log(data);
                        namaProdukDropdown.append($('<option>').text('Pilih Nama Produk')
                            .attr('value', ''));
                        $.each(data, function(key, value) {
                            namaProdukDropdown.append($('<option>').text(value
                                .produk_nama).attr('value', value
                                .produk_kode));
                        });
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error("Request failed: " + textStatus + ", " + errorThrown);
                    });
                } else {
                    namaProdukDropdown.append($('<option>').text('Pilih Nama Produk').attr('value',
                        ''));
                }
            });
        });
    </script>

@endsection
