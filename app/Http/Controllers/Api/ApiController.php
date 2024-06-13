<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk; // Pastikan model Produk diimpor

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            "message" => "Daftar Produk",
            "data" => Produk::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $produk = new Produk;
        $produk->nama = $request->nama;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->save();

        return response()->json($produk, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            return response()->json($produk);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            $produk->nama = $request->nama;
            $produk->deskripsi = $request->deskripsi;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->save();

            return response()->json($produk);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            $produk->delete();
            return response()->json(['message' => 'Produk berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }
    }

    /**
     * Search for a product by name.
     *
     * @param  string  $produk
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($produk)
    {
        $results = Produk::where('nama', 'like', '%'.$produk.'%')->get();
        return response()->json($results);
    }
}
