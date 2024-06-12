<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// jika ingin menggunakan query biasa
use Illuminate\Support\Facades\DB;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $fillable = ['transaksi_no','id_customer','tgl_transaksi','tgl_expired','total_harga','status'];

    // untuk melihat data produk
    public static function getProduk()
    {
        // query ke tabel produk
        $sql = "SELECT * FROM produk where produk_stok > 0";
        $produk = DB::select($sql);
        return $produk;
    }

    // untuk melihat data produk berdasarkan id
    public static function getProdukId($id)
    {
        $sql = "SELECT * FROM produk WHERE id = ?";
        $produk = DB::select($sql,[$id]);
        return $produk;
    }

    // untuk melihat data invoice
    public static function getListInvoice($id_customer)
    {
        $penjualan = Penjualan::where('id_customer', $id_customer)
                                ->where('status', 'siap_bayar')
                                ->get();
        return $penjualan;
    }

    // cekout
    public static function checkout($id_customer)
    {

        // dapatkan nomor transaksinya
        $sql = "SELECT max(transaksi_no) as mak_transaksi_no 
                FROM penjualan WHERE id_customer = ? AND status = 'pesan'";
        $penjualan = DB::select($sql,[$id_customer]);
        foreach($penjualan as $b):
            $transaksi_no = $b->mak_transaksi_no;
        endforeach;

        // update status menjadi siap bayar
        $affected = DB::table('penjualan')
                    ->where('transaksi_no', $transaksi_no)
                    ->update(['status' => 'siap_bayar']);
					
		// tambahkan ke status transaksi
        DB::table('status_transaksi')->insert([
            'transaksi_no' => $transaksi_no,
            'id_customer' => $id_customer,
            'status' => 'siap_bayar',
            'waktu' => now(),
        ]);
    }

    // lihat produk_stok produk
    public static function getStock($produk_id){
        $sql = "SELECT produk_stok FROM produk WHERE id = ?";
        $produk = DB::select($sql,[$produk_id]);
        foreach($produk as $b):
            $produk_stok = $b->produk_stok;
        endforeach;
        return $produk_stok;
    }

    // lihat id ke berapa status pemesanan si customer
    public static function getIdStatus($id_customer){
        $sql = "SELECT ifnull(max(a.id),0) as id 	 
                FROM status_pemesanan a 
                JOIN ( 
                     SELECT status FROM penjualan 
                     WHERE id_customer = ? 
                     AND transaksi_no = ( 
                        SELECT max(transaksi_no) 
                        FROM penjualan WHERE id_customer = ? 
                        ) 
                    UNION
                     SELECT status FROM pembayaran 
                     WHERE transaksi_no = ( 
                        SELECT max(transaksi_no) 
                        FROM penjualan WHERE id_customer = ? 
                        ) 
                ) b ON (a.status=b.status) 
                ";
        $status_pemesanan = DB::select($sql,[$id_customer,$id_customer,$id_customer]);
        foreach($status_pemesanan as $b):
            $id = $b->id;
        endforeach;
        return $id;
    }

    // lihat status pemesanan berdasarkan id customer
    public static function getStatusAll($id_customer){
        $sql = "SELECT a.*,b.status as status_customer,b.waktu as tgl_transaksi 
                FROM status_pemesanan a LEFT OUTER JOIN 
                ( SELECT * FROM status_transaksi WHERE id_customer = ? 
                  AND transaksi_no = ( SELECT max(transaksi_no) FROM penjualan 
                  WHERE id_customer = ? ) ) b ON (a.status=b.status) ORDER BY a.id
                ";
        $status_pemesanan = DB::select($sql,[$id_customer,$id_customer]);
        return $status_pemesanan;
    }

    public static function tes(){
        $penjualan = new Penjualan;
        $faktur = $penjualan->getInvoiceNumber();
        return $faktur;
    }

    // dapatkan nomor faktur yang baru
    public static function getInvoiceNumber(){
        $sql = "SELECT SUBSTRING(IFNULL(MAX(transaksi_no),'FK-0000'),4)+0 AS no 
                FROM penjualan";
        $produk = DB::select($sql);
        foreach($produk as $b):
            $urutan = $b->no;
        endforeach;

        // pembentukan nomor faktur
        $urutan = $urutan + 1;
        $str = (string)$urutan;
        //menambahkan 0 di samping kiri angka
        $no  = str_pad($str,4,"0",STR_PAD_LEFT); 
        $faktur = 'FK-'.$no;
        return $faktur;
    }

    // prosedur input data penjualan 
    public static function inputPenjualan($id_customer,$total_harga,$produk_id,$produk_qty,$produk_harga,$total){
        
        // instansiasi obyek
        $penjualan = new Penjualan;
        // query apakah ada di keranjang
        // query kode perusahaan
        $sql = "SELECT COUNT(*) as jml 
                FROM penjualan 
                WHERE id_customer = ? 
                AND status not in ('expired','selesai','siap_bayar','konfirmasi_bayar')";
        $produk = DB::select($sql,[$id_customer]);
        foreach($produk as $b):
            $jml = $b->jml;
        endforeach;

        // jika jumlahnya 0 maka buat nomor transaksi baru
        // ['transaksi_no','id_customer','tgl_transaksi','tgl_expired','total_harga','status'];
        if($jml==0){

            // dapatkan nomor faktur terakhir cth format FK-0004
            $faktur = $penjualan->getInvoiceNumber();

            // masukkan ke tabel induk dulu yaitu di tabel penjualan
            // baru ke tabel anaknya penjualan_detail
            
            $date = date('Y-m-d H:i:s');
            //tambahkan 3 hari untuk expired datenya dari tanggal sekarang
            $date_plus_3=Date('Y-m-d H:i:s', strtotime('+3 days')); 
            DB::table('penjualan')->insert([
                'transaksi_no' => $faktur,
                'id_customer' => $id_customer,
                'tgl_transaksi' => $date,
                'tgl_expired' => $date_plus_3,
                'total_harga' => $total_harga,
                'status' => 'pesan' //isinya 'pesan','expired','selesai','siap_bayar','konfirmasi_bayar'
            ]);

            // masukkan ke tabel detail_penjualan
            DB::table('penjualan_detail')->insert([
                'transaksi_no' => $faktur,
                'produk_id' => $produk_id,
                'produk_harga' => $produk_harga,
                'produk_qty' => $produk_qty,
                'total' => $total,
                'tgl_transaksi' => $date,
                'tgl_expired' => $date_plus_3
            ]);

            // update produk_stok di tabel produk menjadi berkurang
            // dapatkan produk_stok dulu
            $penjualan = new Penjualan;
            $produk_stok = $penjualan->getStock($produk_id);
            $stok_akhir = $produk_stok - $produk_qty;
            $affected = DB::table('produk')
              ->where('id', $produk_id)
              ->update(['produk_stok' => $stok_akhir]);
			  
			// tambahkan ke status transaksi
            DB::table('status_transaksi')->insert([
                'transaksi_no' => $faktur,
                'id_customer' => $id_customer,
                'status' => 'pesan',
                'waktu' => now(),
            ]);
			
        }else{
            // jika sudah ada nomor fakturnya
            // 1. update transaksi yang masih menggantung ke expired jika di tabel detail sudah expired semua
            //    dapatkan max tgl expired
            $sql = "SELECT transaksi_no,MAX(tgl_expired) as mak_expired 
                    FROM penjualan_detail WHERE  
                    transaksi_no IN 
                    (
                        SELECT transaksi_no
                        FROM penjualan
                        WHERE id_customer = ? 
                        AND status NOT IN ('selesai','expired','siap_bayar','konfirmasi_bayar')
                    ) 
                    GROUP BY transaksi_no
                   ";
            $produk = DB::select($sql,[$id_customer]);
            foreach($produk as $b):
                $mak_expired = $b->mak_expired;
                $transaksi_no = $b->transaksi_no;
            endforeach;

            // update ke tabel transaksi expirednya menjadi expired terlama dari detail penjualan
            $affected = DB::table('penjualan')
              ->where('transaksi_no', $transaksi_no)
              ->update(['tgl_expired' => $mak_expired]);

            // jika mak expired sudah melewati masa sekarang
            // maka lakukan update status pesanan menjadi 'expired'
            $date = date('Y-m-d H:i:s');
            if($date>$mak_expired){
                // update status menjadi expired
                    $affected = DB::table('penjualan')
                ->where('transaksi_no', $transaksi_no)
                ->update(['status' => 'expired']);

                // kembalikan produk_stok
                $sql = "SELECT produk_id,produk_qty 
                        FROM penjualan_detail 
                        WHERE  transaksi_no = ?
                    ";
                $produk = DB::select($sql,[$transaksi_no]);
                foreach($produk as $b):
                    $produk_id = $b->produk_id;
                    $produk_qty_lama = $b->produk_qty;
                    // query produk_stok
                    // kembalikan produk_stok
                    $produk_stok = $penjualan->getStock($produk_id);
                    $stok_akhir = $produk_stok + $produk_qty_lama;
                    $affected = DB::table('produk')
                    ->where('id', $produk_id)
                    ->update(['produk_stok' => $stok_akhir]);
                endforeach;

                // buat nomor faktur baru dan masukkan ke tabel
                // dapatkan nomor faktur terakhir cth format FK-0004
                $faktur = $penjualan->getInvoiceNumber();
				
				// tambahkan ke status transaksi
                DB::table('status_transaksi')->insert([
                    'transaksi_no' => $transaksi_no,
                    'id_customer' => $id_customer,
                    'status' => 'expired',
                    'waktu' => now(),
                ]);
	

                // masukkan ke tabel induk dulu yaitu di tabel penjualan
                
                $date = date('Y-m-d H:i:s');
                $date_plus_3=Date('Y-m-d H:i:s', strtotime('+3 days')); //tambahkan 3 hari untuk expired datenya
                DB::table('penjualan')->insert([
                    'transaksi_no' => $faktur,
                    'id_customer' => $id_customer,
                    'tgl_transaksi' => $date,
                    'tgl_expired' => $date_plus_3,
                    'total_harga' => $total_harga,
                    'status' => 'pesan' //isinya pesan, selesai, expired
                ]);

                // masukkan ke tabel detail_penjualan
                DB::table('penjualan_detail')->insert([
                    'transaksi_no' => $faktur,
                    'produk_id' => $produk_id,
                    'produk_harga' => $produk_harga,
                    'produk_qty' => $produk_qty,
                    'total' => $total,
                    'tgl_transaksi' => $date,
                    'tgl_expired' => $date_plus_3
                ]);

                // update produk_stok di tabel produk menjadi berkurang
                // dapatkan produk_stok dulu
                $produk_stok = $penjualan->getStock($produk_id);
                $stok_akhir = $produk_stok - $produk_qty;
                $affected = DB::table('produk')
                ->where('id', $produk_id)
                ->update(['produk_stok' => $stok_akhir]);
                // akhir buat nomor faktur baru
				
				// tambahkan ke status transaksi
                DB::table('status_transaksi')->insert([
                    'transaksi_no' => $faktur,
                    'id_customer' => $id_customer,
                    'status' => 'pesan',
                    'waktu' => now(),
                ]);

            }else{
                // belum mencapai masa expired, maka
                // tambahkan total belanja ke tabel penjualan_detail
                // cek untuk id produk yang sama, maka tidak usah tambah lagi, 
                // tapi cukup jml belanjanya diupdate
                // selain itu masukkan lagi ke penjualan detail
                // 1. cek apakah yg diinputkan adalah id produk yang sudah ada di keranjang atau tidak
                $sql = "SELECT produk_id,produk_qty,transaksi_no FROM penjualan_detail
                        WHERE  
                        transaksi_no IN 
                        (
                            SELECT transaksi_no
                            FROM penjualan
                            WHERE id_customer = ? AND status NOT IN ('selesai','expired','siap_bayar','konfirmasi_bayar')
                        ) AND produk_id = ?
                        ";
                $produk = DB::select($sql,[$id_customer,$produk_id]);
                $cek = 0;
                foreach($produk as $b):
                    $produk_id_tabel = $b->produk_id;
                    $produk_qty_tabel = $b->produk_qty;
                    $transaksi_no_tabel = $b->transaksi_no;
                    $cek = 1;
                    // tambahkan jml produknya dan tamnbahkan masa expirednya
                    $date_plus_3=Date('Y-m-d H:i:s', strtotime('+3 days')); //tambahkan 3 hari untuk expired datenya
                    $produk_qty_akhir = $produk_qty + $produk_qty_tabel;
                    $total_tagihan  = $produk_harga * $produk_qty_akhir;
                    $affected = DB::table('penjualan_detail')
                    ->where('transaksi_no','=', $transaksi_no_tabel)
                    ->where('produk_id', '=',$produk_id_tabel)
                    ->update(['produk_qty' => $produk_qty_akhir,'total'=> $total_tagihan,
                              'tgl_transaksi' => $date_plus_3
                             ]);

                    // dapatkan produk_stok dulu
                    $produk_stok = $penjualan->getStock($produk_id);
                    $stok_akhir = $produk_stok - $produk_qty;
                    $affected = DB::table('produk')
                    ->where('id', $produk_id)
                    ->update(['produk_stok' => $stok_akhir]);

                endforeach;

                // jika nilai variabel cek == 0 maka ini adalah inputan baru
                if($cek==0){
                    // 
                    // buat nomor faktur baru dan masukkan ke tabel
                    // dapatkan nomor faktur terakhir cth format FK-0004
                    $sql = "SELECT max(transaksi_no) as transaksi_no  FROM penjualan
                            WHERE id_customer = ? AND status NOT IN ('selesai','expired','siap_bayar','konfirmasi_bayar')
                           ";
                    $produk = DB::select($sql,[$id_customer]);
                    foreach($produk as $b):
                        $transaksi_no = $b->transaksi_no;
                    endforeach;

                    $sql = "SELECT total_harga  FROM penjualan
                            WHERE transaksi_no = ? 
                           ";
                    $produk = DB::select($sql,[$transaksi_no]);
                    foreach($produk as $b):
                        $total_harga_lama = $b->total_harga;
                    endforeach;

                    // $total_harga_lama = $b->total_harga;
                    // masukkan ke tabel induk dulu yaitu di tabel penjualan
                    $total_harga_baru = $total_harga+$total_harga_lama;
                    $date = date('Y-m-d H:i:s');
                    $date_plus_3=Date('Y-m-d H:i:s', strtotime('+3 days')); //tambahkan 3 hari untuk expired datenya
                    // update total produk_harga di penjualan karena sudah ditambah item baru
                    $affected = DB::table('penjualan')
                    ->where('transaksi_no', $transaksi_no)
                    ->update(
                                [   'tgl_expired' => $date_plus_3,
                                    'total_harga'=> $total_harga_baru, 
                                ]
                            );

                    // masukkan ke tabel detail_penjualan
                    DB::table('penjualan_detail')->insert([
                        'transaksi_no' => $transaksi_no,
                        'produk_id' => $produk_id,
                        'produk_harga' => $produk_harga,
                        'produk_qty' => $produk_qty,
                        'total' => $total,
                        'tgl_transaksi' => $date,
                        'tgl_expired' => $date_plus_3
                    ]);

                    // update produk_stok di tabel produk menjadi berkurang
                    // dapatkan produk_stok dulu
                    $produk_stok = $penjualan->getStock($produk_id);
                    $stok_akhir = $produk_stok - $produk_qty;
                    $affected = DB::table('produk')
                    ->where('id', $produk_id)
                    ->update(['produk_stok' => $stok_akhir]);
                    // akhir buat nomor faktur baru
                    
                }
            }
        }
        
    }

    // view keranjang belanja
    public static function viewKeranjang($id_customer){
        $sql = "SELECT  a.transaksi_no,
                        c.produk_nama,
                        c.produk_foto,
                        c.produk_harga,
                        b.tgl_transaksi,
                        b.tgl_expired,
                        b.produk_qty,
                        b.total,
                        a.status,
                        b.id as id_penjualan_detail
                FROM penjualan a
                JOIN penjualan_detail b
                ON (a.transaksi_no=b.transaksi_no)
                JOIN produk c 
                ON (b.produk_id = c.id)
                WHERE a.id_customer = ? AND a.status 
                not in ('selesai','expired','siap_bayar','konfirmasi_bayar')";
        $produk = DB::select($sql,[$id_customer]);
        return $produk;
    }

    // view data siap bayar
    // view keranjang belanja
    public static function viewSiapBayar($id_customer){
        $sql = "SELECT  a.transaksi_no,
                        c.produk_nama,
                        c.produk_foto,
                        c.produk_harga,
                        b.tgl_transaksi,
                        b.tgl_expired,
                        b.produk_qty,
                        b.total,
                        a.status,
                        b.id as id_penjualan_detail,
                        a.id as id_penjualan
                FROM penjualan a
                JOIN penjualan_detail b
                ON (a.transaksi_no=b.transaksi_no)
                JOIN produk c 
                ON (b.produk_id = c.id)
                WHERE a.id_customer = ? AND a.status 
                in ('siap_bayar')";
        $produk = DB::select($sql,[$id_customer]);
        return $produk;
    }

    public static function jmlviewSiapBayar($id_customer){
        $sql = "SELECT  count(*) as jml
                FROM penjualan a
                JOIN penjualan_detail b
                ON (a.transaksi_no=b.transaksi_no)
                JOIN produk c 
                ON (b.produk_id = c.id)
                WHERE a.id_customer = ? AND a.status 
                in ('siap_bayar')";
        $produk = DB::select($sql,[$id_customer]);
        return $produk;
    }

    // untuk menghapus data penjualan detail
    public static function hapuspenjualandetail($id_penjualan_detail){
        // dapatkan nomor transaksi dulu
        $sql = "SELECT  transaksi_no
                FROM penjualan_detail
                WHERE id = ? ";
        $transaksi = DB::select($sql,[$id_penjualan_detail]);
        foreach($transaksi as $b):
            $no = $b->transaksi_no;
        endforeach;

        // hapus datanya
        $sql = "DELETE FROM penjualan_detail WHERE id = ?";
        $nrd = DB::delete($sql,[$id_penjualan_detail]);

        
        // hitung total produk_harga dari jml di penjualan detail
        $sql = "SELECT  SUM(total) as ttl
                FROM penjualan_detail
                WHERE transaksi_no = ? ";
        $total = DB::select($sql,[$no]);
        foreach($total as $b):
            $ttl = $b->ttl;
        endforeach;
        
        // update total produk_harga di tabel penjualan
        $affected = DB::table('penjualan')
          ->where('transaksi_no', $no)
          ->update(['total_harga' => $ttl]);
    }

    // kembalikan produk_stok
    public static function kembalikanstok($id_penjualan_detail){
        $penjualan = new Penjualan;
        $sql = "SELECT produk_qty,produk_id FROM penjualan_detail WHERE id = ?";
        $produk = DB::select($sql,[$id_penjualan_detail]);
        foreach($produk as $b):
            $produk_qty = $b->produk_qty;
            $produk_id = $b->produk_id;
        endforeach;

        $produk_stok = $penjualan->getStock($produk_id);
        $stok_akhir = $produk_stok + $produk_qty;
        $affected = DB::table('produk')
          ->where('id', $produk_id)
          ->update(['produk_stok' => $stok_akhir]);
    }

    // dapatkan jumlah produk
    public static function getJmlProduk($id_customer){
        $sql = "SELECT count(*) as jml FROM penjualan_detail 
                WHERE transaksi_no IN 
                (SELECT transaksi_no FROM penjualan 
                 WHERE id_customer = ? AND status 
                 NOT IN ('expired','hapus','siap_bayar','konfirmasi_bayar','selesai')
                )";
        $produk = DB::select($sql,[$id_customer]);
        foreach($produk as $b):
            $jml = $b->jml;
        endforeach;
        return $jml;
    }

    public static function getJmlInvoice($id_customer){
        $sql = "SELECT count(*) as jml FROM penjualan 
                WHERE status = 'siap_bayar' AND id_customer = ?";
        $produk = DB::select($sql,[$id_customer]);
        foreach($produk as $b):
            $jml = $b->jml;
        endforeach;
        return $jml;
    }


}
