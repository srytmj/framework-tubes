@extends('layoutbootstrap')

@section('konten')
    <div class="body-wrapper">
        <header class="app-header">
            <!-- Header content -->
        </header>

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Data Bahan Baku {{ $produk->produk_nama }}</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produkdetail.store') }}" method="post">
                        @csrf

                        <!-- Input Hidden for produkId -->
                        <input type="" id="produkId" name="produkId"value="{{ $produkId }}">

                        <!-- Input Hidden for produk_kode -->
                        <input type="" id="produk_kode" name="produk_kode" value="{{ $produk->produk_kode }}">

                        <div class="mb-3">
                            <label for="bahanbaku_jenis">Jenis bahanbaku</label>
                            <select class="form-control form-control-solid" id="bahanbaku_jenis" name="bahanbaku_jenis"
                                required>
                                <option value="">Pilih Jenis Bahan Baku</option>
                                @foreach ($bahanbakuJenisList as $jenis)
                                    <option value="{{ $jenis->bahanbaku_jenis }}"
                                        {{ old('bahanbaku_jenis') == $jenis->bahanbaku_jenis ? 'selected' : '' }}>
                                        {{ $jenis->bahanbaku_jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="bahanbaku_nama">Nama Bahan Baku</label>
                            <select class="form-control form-control-solid" id="bahanbaku_nama" name="bahanbaku_kode"
                                required>
                                <option value="">Pilih Nama Bahan Baku</option>
                                <!-- Nama bahan baku akan diisi secara dinamis -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah">Jumlah</label>
                            <input class="form-control form-control-solid" id="jumlah" name="jumlah" type="number"
                                placeholder="Masukkan Jumlah" value="{{ old('jumlah') }}" required>
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
            $('#bahanbaku_jenis').change(function() {
                let jenis = $(this).val();
                let namaBahanBakuDropdown = $('#bahanbaku_nama');

                namaBahanBakuDropdown.empty();

                if (jenis) {
                    $.get("{{ route('getBahanBakuByJenis') }}", {
                        jenis: jenis
                    }, function(data) {
                        console.log(data);
                        namaBahanBakuDropdown.append($('<option>').text('Pilih Nama Bahan Baku')
                            .attr('value', ''));
                        $.each(data, function(key, value) {
                            namaBahanBakuDropdown.append($('<option>').text(value
                                .bahanbaku_nama).attr('value', value
                                .bahanbaku_kode));
                        });
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error("Request failed: " + textStatus + ", " + errorThrown);
                    });
                } else {
                    namaBahanBakuDropdown.append($('<option>').text('Pilih Nama Bahan Baku').attr('value',
                        ''));
                }
            });
        });
    </script>

@endsection
