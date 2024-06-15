<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB; // Add this line

class Grafik extends Model
{
    use HasFactory;

    // untuk mendapatkan view grafik per bulan berjalan
    public static function viewBulanBerjalan()
    {
        // query kode perusahaan
        $sql = "
                SELECT a.waktu, IFNULL(b.total, 0) AS total 
                FROM v_waktu a 
                LEFT OUTER JOIN (
                    SELECT DATE_FORMAT(tgl_transaksi, '%Y-%m') AS waktu,
                        SUM(total_harga) AS total
                    FROM penjualan
                    WHERE status = 'selesai'
                    GROUP BY DATE_FORMAT(tgl_transaksi, '%Y-%m')
                ) b
                ON (a.waktu COLLATE utf8mb4_general_ci) = (b.waktu COLLATE utf8mb4_general_ci); ";
        $hasil = DB::select($sql);

        return $hasil;
    }

    // untuk mendapatkan view grafik status penjualan
    public static function viewJmlPenjualan()
    {
        $sql = "SELECT b.produk_nama,sum(a.produk_qty) as jml_penjualan 
                FROM penjualan_detail a 
                    join produk b on (a.produk_id=b.id)
                    join penjualan c on (a.transaksi_no=c.transaksi_no)
                WHERE c.status = 'selesai'
                GROUP BY  b.produk_nama";
        $hasil = DB::select($sql);

        return $hasil;

    }

    // untuk mendapatkan view grafik jml produk terjual
    public static function viewJmlProdukTerjual()
    {
        $sql = "
                SELECT ax.waktu,
                    (SELECT ifnull(SUM(produk_qty),0) 
                    FROM penjualan a 
                        JOIN penjualan_detail b
                        ON (a.transaksi_no=b.transaksi_no)
                        JOIN produk c
                        ON (b.produk_id=c.id)
                        WHERE a.status = 'selesai' 
                        AND c.id = 1
                        AND CAST(DATE_FORMAT(a.tgl_transaksi,'%Y-%m') AS CHAR CHARACTER SET utf8mb4) = ax.waktu
                    ) as jml_lays,
                    (SELECT ifnull(SUM(produk_qty),0) 
                    FROM penjualan a 
                        JOIN penjualan_detail b
                        ON (a.transaksi_no=b.transaksi_no)
                        JOIN produk c
                        ON (b.produk_id=c.id)
                        WHERE a.status = 'selesai' 
                        AND c.id = 2
                        AND CAST(DATE_FORMAT(a.tgl_transaksi,'%Y-%m') AS CHAR CHARACTER SET utf8mb4) = ax.waktu
                    ) as jml_biskuit,
                    (SELECT ifnull(SUM(produk_qty),0) 
                    FROM penjualan a 
                        JOIN penjualan_detail b
                        ON (a.transaksi_no=b.transaksi_no)
                        JOIN produk c
                        ON (b.produk_id=c.id)
                        WHERE a.status = 'selesai' 
                        AND c.id = 3
                        AND CAST(DATE_FORMAT(a.tgl_transaksi,'%Y-%m') AS CHAR CHARACTER SET utf8mb4) = ax.waktu
                    ) as jml_ice_cream,
                    (SELECT ifnull(SUM(produk_qty),0) 
                    FROM penjualan a 
                        JOIN penjualan_detail b
                        ON (a.transaksi_no=b.transaksi_no)
                        JOIN produk c
                        ON (b.produk_id=c.id)
                        WHERE a.status = 'selesai' 
                        AND c.id = 4
                        AND CAST(DATE_FORMAT(a.tgl_transaksi,'%Y-%m') AS CHAR CHARACTER SET utf8mb4) = ax.waktu
                    ) as jml_pensil
                FROM 
                v_waktu ax;";
        $hasil = DB::select($sql);

        return $hasil;

    }

    // untuk mendapatkan view grafik per bulan berjalan
    public static function viewPenjualan()
    {
        // query kode perusahaan
        $sql = "
                    SELECT DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') as tgl, 
                            SUM(total_harga) as total
                    FROM penjualan
                    GROUP BY DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')
                    ORDER BY 1
               ";
        $hasil = DB::select($sql);

        return $hasil;

    }

    public static function viewTahun(){
        $sql = "
                    SELECT DISTINCT(DATE_FORMAT(tgl_transaksi,'%Y')) as tahun
                    FROM penjualan
                    ORDER BY 1";
        $hasil = DB::select($sql);

        return $hasil;
    }

    // untuk mendapatkan view grafik per bulan berjalan
    public static function viewPenjualanSelectOption($tahun)
    {
        // query kode perusahaan
        $sql = "
                    SELECT a.wkt,ifnull(b.total,0) as total FROM 
                        (SELECT concat(waktu,'-','".$tahun."') as wkt
                         FROM v_waktu_parameter 
                        ) a 
                    LEFT OUTER JOIN
                    (
                        SELECT DATE_FORMAT(tgl_transaksi,'%m-%Y') as waktu,
                            SUM(total_harga) as total
                        FROM penjualan
                        WHERE status = 'selesai'
                        and DATE_FORMAT(tgl_transaksi,'%Y') = ?
                        GROUP BY DATE_FORMAT(tgl_transaksi,'%m-%Y')
                    ) b
                    ON (a.wkt=b.waktu) 
                    ";
        $hasil = DB::select($sql,[$tahun]);

        return $hasil;

    }
}
