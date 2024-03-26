@extends('layout3')

@section('konten')

<h1>Data Barang</h1>

<ul>
    @foreach ($barang as $p)
        <li>{{"Kode Barang : ".$p->kode_barang. '| Nama Akun : '.$p->nama_barang. "| Harga Barang :".$p->harga_barang. "Stok Barang :".$p->stok_barang}}</li>
        @endforeach
</ul>

@endsection