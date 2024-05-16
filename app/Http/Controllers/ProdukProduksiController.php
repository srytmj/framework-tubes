<?php

namespace App\Http\Controllers;

use App\Models\ProdukProduksi;
use App\Http\Requests\StoreProdukProduksiRequest;
use App\Http\Requests\UpdateProdukProduksiRequest;

class ProdukProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdukProduksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProdukProduksi $produkProduksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProdukProduksi $produkProduksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdukProduksiRequest $request, ProdukProduksi $produkProduksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdukProduksi $produkProduksi)
    {
        //
    }

    public function produksi(Request $request, $id) {
        DB::transaction(function () use ($request, $id) {
            $produk = Produk::findOrFail($id);
            $produk->produk_stok += $request->jumlah_produksi;
            $produk->save();

            foreach ($produk->produkdetails as $detail) {
                $bahanbaku = BahanBaku::findOrFail($detail->bahanbaku_id);
                $bahanbaku->bahanbaku_stok -= $detail->jumlah * $request->jumlah_produksi;
                $bahanbaku->save();
            }
        });

        return back()->with('success', 'Produksi berhasil dilakukan.');
    }
}
