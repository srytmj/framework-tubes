<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //untuk mendapatkan auth
use App\Models\Penjualan; //untuk akses kelas model penjualan
use Illuminate\Support\Facades\DB; //untuk db
use App\Models\Pembayaran; //untuk auto refresh

class CobaMidtransController extends Controller
{
    //untuk contoh sederhana midtrans
    public function index(Request $request)
    {
        // definisikan parameter midtrans
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => 10000,
            'quantity' => 3,
            'name' => "Apple"
        );

        // Optional
        $item2_details = array(
            'id' => 'a2',
            'price' => 20000,
            'quantity' => 1,
            'name' => "Orange"
        );

        // Optional
        $item_details = array ($item1_details, $item2_details);

        // Optional, remove this to display all available payment methods
        $enable_payments = array("bca_va","bni_va");

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(), //idpesanan ini nanti dpt diambil dari no_pesanan
                'gross_amount' => 50000,
            ),
            'customer_details' => array(
                'first_name' => 'nikita',
                'last_name' => 'willy',
                'email' => 'nikita@gmail.com',
                'phone' => '0821142334',
            ),
            'item_details' => $item_details,
            'enabled_payments' => $enable_payments,
        );
         
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($snapToken);
        return view(    'midtrans.view',
                        [
                            'snap_token' => $snapToken,
                        ]
        );
    }

    // cek status berdasarkan id
    public function cekstatus($id){
    
        $ch = curl_init(); 
        $login = env('MIDTRANS_SERVER_KEY');
        $password = '';
        $orderid = $id;
        $URL =  'https://api.sandbox.midtrans.com/v2/'.$orderid.'/status';
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");  
        $output = curl_exec($ch); 
        curl_close($ch);    
        $outputjson = json_decode($output, true); //diparsing sebagai array karena pakai true
        echo "<pre>";
        print_r($outputjson);
        echo "</pre>";
        echo "<hr>";
        echo $outputjson['status_code']."<br>";
        echo $outputjson['payment_type']."<br>";
        echo $outputjson['transaction_status']."<br>";
        echo $outputjson['transaction_time']."<br>";
        echo $outputjson['settlement_time']."<br>";
        echo $outputjson['status_message']."<br>";
        echo $outputjson['merchant_id']."<br>";
    }

    // cek status dari data pembayaran mukena yang belum terupdate pembayarannya
    // oleh data payment gateway
    public function cekstatus2(){
    
        //query data transaksi yang masih pending	
		$hasil = Pembayaran::viewstatusPGAll();
        $id = array();
        $transaksi_no = array();
		foreach($hasil as $ks){
			array_push($id,$ks->order_id);
            array_push($transaksi_no,$ks->transaksi_no);
		}
        for($i=0; $i<count($id); $i++){
            $ch = curl_init(); 
            $login = env('MIDTRANS_SERVER_KEY');
            $password = '';
            $orderid = $id[$i];
            $transaksi_no = $transaksi_no[$i];
            $URL =  'https://api.sandbox.midtrans.com/v2/'.$orderid.'/status';
            curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");  
            $output = curl_exec($ch); 
            curl_close($ch);    
            $outputjson = json_decode($output, true); //parsing json dalam bentuk assosiative array
            // var_dump($outputjson);

            $affected = DB::table('pg_penjualan')->where('order_id', $orderid)
            ->update([
                'status_code' => $outputjson['status_code'],
                'transaction_status' => $outputjson['transaction_status'],
                'transaction_time' => $outputjson['transaction_time'],
                'settlement_time' => $outputjson['settlement_time'],
                'status_message' => $outputjson['status_message'],
                'merchant_id' => $outputjson['merchant_id']
            ]);

            // simpan data
            $empData = ['transaksi_no' => $transaksi_no, 'tgl_bayar' => $outputjson['transaction_time'], 'bukti_bayar' => 'midtrans-logo.png', 'jenis_pembayaran' => 'pg', 'status' => 'approved'];
            Pembayaran::create($empData);

            // update status
            $affected = DB::table('penjualan')
              ->where('transaksi_no', $transaksi_no)
              ->update(['status' => 'selesai']);
        }

        return redirect('pembayaran/viewstatusPG');
    }

    // bayar
    public function bayar(){
        //id customer dari session, ini bisa diganti sesuai kebutuhan
        $id_customer = Auth::id();
        $keranjang = Penjualan::viewSiapBayar($id_customer);
        $jml_data = Penjualan::jmlviewSiapBayar($id_customer);

        foreach($jml_data as $k):
            $jml = $k->jml;
        endforeach;

        if($jml>0){
            // 
            // dapatkan total tagihan
            $transaksi_no = '';
            $totaltagihan = 0;
            
            $myArray = array(); //untuk menyimpan objek array
            foreach($keranjang as $k):
                $transaksi_no = $k->transaksi_no ;
                $totaltagihan = $totaltagihan + $k->total ;

                // untuk data item detail
                // kita perlu membuat objek dulu kemudian di masukkan ke array
                $foo = array(
                        'id'=> $k->id_penjualan_detail,
                        'price' => $k->produk_harga,
                        'quantity' => $k->produk_qty,
                        'name' => $k->produk_nama,

                );
                // tambahkan ke myarray
                array_push($myArray,$foo);

            endforeach;

            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(), //idpesanan ini nanti bisa diambil dari no_pesanan
                    'gross_amount' => $totaltagihan, //gross amount diisi total tagihan
                ),
                'item_details' => $myArray,
                'customer_details' => array(
                    'first_name' => Auth::user()->name,
                    'last_name' => '',
                    'email' => Auth::user()->email,
                    'phone' => '',
                ),
            );
            
            $snapToken = \Midtrans\Snap::getSnapToken($params);


            return view('midtrans.viewcheckout',
                        [
                            'keranjang' => $keranjang,
                            'snap_token' => $snapToken,
                        ]
                    );
            // 
        }else{
            // tidak ada keranjang kembalikan ke depan
            return redirect('/pembayaran/viewstatusPG');
        }
    }

    // proses bayar
    public function proses_bayar(Request $request){
        
        $json  = json_decode($request->x_json);


        $id_penjualan = $request->input('id_penjualan');
        $order_id = $json->order_id;
        $gross_amount = $json->gross_amount;
        $transaction_status = $json->transaction_status;
        $transaction_id = $json->transaction_id;
        $payment_type = $json->payment_type;
        $status_code = $json->status_code;
        DB::insert('insert into pg_penjualan (id_penjualan, order_id, gross_amount, transaction_id, payment_type, status_code) values (?, ?, ?, ?, ?, ?)', [$id_penjualan, $order_id, $gross_amount, $transaction_id, $payment_type, $status_code]);

        // query dapatkan nilai nominal transaksi
        $data_penjualan = DB::table('penjualan')->where('id', $id_penjualan)->first();
        // $data_pgpenjualan = DB::table('pg_penjualan')->where('id', $id_penjualan)->first();

        //catat ke jurnal
        DB::table('jurnal')->insert([
            'transaksi_id' => $data_penjualan->id,
            'id_perusahaan' => 1, //bisa diganti kalau sudah live
            'kode_akun' => '111',
            'tgl_jurnal' => now(),
            'posisi_d_c' => 'd',
            'nominal' => $data_penjualan->total_harga,
            'kelompok' => 1,
            'transaksi' => 'penjualan',
        ]);

        DB::table('jurnal')->insert([
            'transaksi_id' => $data_penjualan->id,
            'id_perusahaan' => 1, //bisa diganti kalau sudah live
            'kode_akun' => '411',
            'tgl_jurnal' => now(),
            'posisi_d_c' => 'c',
            'nominal' => $data_penjualan->total_harga,
            'kelompok' => 4,
            'transaksi' => 'penjualan',
        ]);

        return redirect('midtrans/status');
    }
}
