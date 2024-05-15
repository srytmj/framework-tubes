@extends('layoutbootstrap')

@section('konten')
    <div class="body-wrapper">
        <header class="app-header">
            <!-- Header content -->
        </header>

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Data Bahan Baku</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('bahanbakupembeliandetail.store') }}" method="post">
                        @csrf

                        <!-- Input Hidden for bahanbaku_pembelian_kode -->
                        <input type="" id="bahanbaku_pembelian_kode" name="bahanbaku_pembelian_kode"
                            value="{{ $bahanbakuPembelianKode }}">

                        <!-- Input Hidden for bahanbaku_pembelian_kode -->
                        <input type="" id="bahanbaku_pembelian_id" name="bahanbaku_pembelian_id"
                            value="{{ $bahanbakuPembelianId }}">

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
                            <label for="kuantitas">Kuantitas</label>
                            <input class="form-control form-control-solid" id="kuantitas" name="kuantitas" type="number"
                                placeholder="Masukkan Kuantitas" value="{{ old('kuantitas') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="harga_satuan">Harga Satuan</label>
                            <input class="form-control form-control-solid" id="harga_satuan" name="harga_satuan"
                                type="number" placeholder="Masukkan Harga Satuan" value="{{ old('harga_satuan') }}"
                                required>
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
