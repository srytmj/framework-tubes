<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Grafik;

class GrafikController extends Controller
{
    // // view bulan berjalan
    public function viewPenjualanBlnBerjalan(){
        $grafik = Grafik::viewBulanBerjalan();
        return view('grafik.bulanberjalan',
                        [
                            'grafik' => $grafik
                        ]
                    );
    }

    // view status penjualan
    public function viewJmlPenjualan(){
        $grafik = Grafik::viewJmlPenjualan();
        return view('grafik.jmlpenjualan',
                        [
                            'grafik' => $grafik
                        ]
                    );
    }

    // view jml barang terjual
    public function viewJmlBarangTerjual(){
        $grafik = Grafik::viewJmlBarangTerjual();
        return view('grafik.bulanberjalanperbarang',
                        [
                            'grafik' => $grafik
                        ]
                    );
    }

    // view jml penjualan select option
    public function viewPenjualanSelectOption($tahun){
        $daftartahun = Grafik::viewTahun();
        $grafik = Grafik::viewPenjualanSelectOption($tahun);
        // return $grafik;
        return view('grafik.penjualan',
                        [
                            'grafik' => $grafik,
                            'daftartahun' => $daftartahun
                        ]
                    );
    }

    // viewDataPenjualanSelectOption
    public function viewDataPenjualanSelectOption($tahun){
        $grafik = Grafik::viewPenjualanSelectOption($tahun);
        return response()->json([
            'grafik'=>$grafik,
        ]);
    }
}
