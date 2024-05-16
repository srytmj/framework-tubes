<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Pembayaran extends Model
{
    use HasFactory;

    // use HasFactory;
    protected $table = "pembayaran";

    // untuk melist kolom yang dapat dimasukkan
    protected $fillable = [
        'transaksi_no',
        'tgl_bayar',
        'tgl_konfirmasi',
        'bukti_bayar',
        'jenis_pembayaran',
        'status'
    ];

    public static function updateStatusKonformasiPembayaran($transaksi_no,$id_customer)
    {
        $affected = DB::table('penjualan')
              ->where('transaksi_no', $transaksi_no)
              ->update(['status' => 'konfirmasi_bayar']);

        // tambahkan ke status transaksi
        DB::table('status_transaksi')->insert([
            'transaksi_no' => $transaksi_no,
            'id_customer' => $id_customer,
            'status' => 'menunggu_approve',
            'waktu' => now(),
        ]);


    }

    // viewstatus pembayaran seluruh customer
    public static function viewstatusall()
    {
        // query kode perusahaan
        $sql = "SELECT a.id,a.transaksi_no,DATE_FORMAT(a.tgl_bayar,'%Y-%m-%d') as tgl_bayar,a.tgl_konfirmasi,a.bukti_bayar,
                        a.jenis_pembayaran,a.status,
                        b.total_harga,
                        GROUP_CONCAT(d.produk_nama ORDER BY d.produk_nama) as list_barang
                FROM pembayaran a
                LEFT OUTER JOIN penjualan b
                ON (a.transaksi_no=b.transaksi_no)
                LEFT OUTER JOIN penjualan_detail c
                ON (b.transaksi_no=c.transaksi_no)
                LEFT OUTER JOIN produk d
                ON (c.produk_id=d.id)
                GROUP BY a.id,a.transaksi_no,DATE_FORMAT(a.tgl_bayar,'%Y-%m-%d'),a.tgl_konfirmasi,a.bukti_bayar,
                        a.jenis_pembayaran,a.status,
                        b.total_harga";
        $list = DB::select($sql);

        return $list;
    }

    // untuk view status pembayaran berdasarkan id customer tertentu
    public static function viewstatus($id_customer)
    {
        // query kode perusahaan
        $sql = "SELECT a.id,a.transaksi_no,a.tgl_bayar,a.tgl_konfirmasi,a.bukti_bayar,
                        a.jenis_pembayaran,a.status,
                        b.total_harga,
                        GROUP_CONCAT(d.produk_nama ORDER BY d.produk_nama) as list_barang
                FROM pembayaran a
                LEFT OUTER JOIN penjualan b
                ON (a.transaksi_no=b.transaksi_no)
                LEFT OUTER JOIN penjualan_detail c
                ON (b.transaksi_no=c.transaksi_no)
                LEFT OUTER JOIN produk d
                ON (c.produk_id=d.id)
                WHERE b.id_customer = ?
                GROUP BY a.id,a.transaksi_no,a.tgl_bayar,a.tgl_konfirmasi,a.bukti_bayar,
                        a.jenis_pembayaran,a.status,
                        b.total_harga";
        $list = DB::select($sql,[$id_customer]);

        return $list;
    }

    // untuk view status pembayaran berdasarkan id customer tertentu untuk PG
    public static function viewstatusPG($id_customer)
    {
        // query kode perusahaan
        $sql = "SELECT b.*,c.status_code,c.transaction_status,c.settlement_time
                FROM penjualan b
                LEFT OUTER JOIN pg_penjualan c
                ON (b.id=c.id_penjualan)
                WHERE b.id_customer = ? AND b.status in ('selesai','siap_bayar')
                AND b.transaksi_no NOT IN 
                (SELECT transaksi_no FROM pembayaran WHERE jenis_pembayaran = 'tunai')
                ";
        $list = DB::select($sql,[$id_customer]);

        return $list;
    }

    // untuk view status pembayaran berdasarkan id customer tertentu untuk PG
    public static function viewstatusPGAll()
    {
        // query kode perusahaan
        $sql = "SELECT b.*,c.status_code,c.order_id
                FROM penjualan b
                JOIN pg_penjualan c
                ON (b.id=c.id_penjualan)
                WHERE b.status in ('siap_bayar')
                AND b.transaksi_no NOT IN 
                (SELECT transaksi_no FROM pembayaran WHERE jenis_pembayaran = 'tunai')
                ";
        $list = DB::select($sql);

        return $list;
    }
}
