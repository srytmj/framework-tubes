<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('produk_kode', 6)->nullable();
            $table->string('produk_nama', 50)->nullable();
            $table->string('produk_jenis', 50)->nullable();
            $table->integer('produk_harga')->nullable();
            $table->integer('produk_stok')->default(0);
            $table->string('produk_foto')->nullable();
            $table->timestamps(0);
        });

        DB::table('produk')->insert([
            [
                'produk_kode' => 'PR001',
                'produk_nama' => 'Es Teh Manis / Teh Hangat',
                'produk_jenis' => 'Minuman',
                'produk_harga' => 5000,
                'produk_stok' => 3,
                'produk_foto' => 'esteh.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'produk_kode' => 'PR002',
                'produk_nama' => 'Es Jeruk / Jeruk Hangat',
                'produk_jenis' => 'Minuman',
                'produk_harga' => 6000,
                'produk_stok' => 1,
                'produk_foto' => 'esjeruk.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'produk_kode' => 'PR003',
                'produk_nama' => 'Ayam Goreng',
                'produk_jenis' => 'Ayam',
                'produk_harga' => 15000,
                'produk_stok' => 6,
                'produk_foto' => 'ayamgoreng.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'produk_kode' => 'PR004',
                'produk_nama' => 'Bebek Goreng',
                'produk_jenis' => 'Bebek',
                'produk_harga' => 25000,
                'produk_stok' => 0,
                'produk_foto' => 'bebekgoreng.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'produk_kode' => 'PR005',
                'produk_nama' => 'Lele Goreng',
                'produk_jenis' => 'Ikan',
                'produk_harga' => 15000,
                'produk_stok' => 0,
                'produk_foto' => 'lelegoreng.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            // [
            //     'produk_kode' => 'PR001',
            //     'produk_nama' => 'Nasi Putih',
            //     'produk_jenis' => 'Nasi',
            //     'produk_harga' => 5000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR002',
            //     'produk_nama' => 'Nasi Uduk',
            //     'produk_jenis' => 'Nasi',
            //     'produk_harga' => 7000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR003',
            //     'produk_nama' => 'Gurami Bakar',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 35000,
            //     'produk_stok' => 4,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR004',
            //     'produk_nama' => 'Gurame Goreng',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 30000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR005',
            //     'produk_nama' => 'Gurame Goreng Kremes',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 35000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR006',
            //     'produk_nama' => 'Gurame Bakar Kremes',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 40000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR007',
            //     'produk_nama' => 'Nila Bakar',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 25000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR008',
            //     'produk_nama' => 'Nila Goreng',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 20000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR009',
            //     'produk_nama' => 'Nila Goreng Kremes',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 25000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR010',
            //     'produk_nama' => 'Nila Bakar Kremes',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 30000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR011',
            //     'produk_nama' => 'Bawal Bakar',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 30000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR012',
            //     'produk_nama' => 'Bawal Goreng',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 25000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR013',
            //     'produk_nama' => 'Bawal Bakar Kremes',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 35000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR014',
            //     'produk_nama' => 'Bawal Goreng Kremes',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 30000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR015',
            //     'produk_nama' => 'Lele Goreng',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 15000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR016',
            //     'produk_nama' => 'Lele Goreng Kremes',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 20000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR017',
            //     'produk_nama' => 'Lele Penyet',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 18000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR018',
            //     'produk_nama' => 'Ayam Goreng',
            //     'produk_jenis' => 'Ayam',
            //     'produk_harga' => 15000,
            //     'produk_stok' => 6,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR019',
            //     'produk_nama' => 'Ayam Bakar',
            //     'produk_jenis' => 'Ayam',
            //     'produk_harga' => 20000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR020',
            //     'produk_nama' => 'Ayam Goreng Kremes',
            //     'produk_jenis' => 'Ayam',
            //     'produk_harga' => 17000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR021',
            //     'produk_nama' => 'Ayam Bakar Kremes',
            //     'produk_jenis' => 'Ayam',
            //     'produk_harga' => 22000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR022',
            //     'produk_nama' => 'Ayam Penyet',
            //     'produk_jenis' => 'Ayam',
            //     'produk_harga' => 18000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR023',
            //     'produk_nama' => 'Ayam Geprek',
            //     'produk_jenis' => 'Ayam',
            //     'produk_harga' => 20000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR024',
            //     'produk_nama' => 'Ayam Goreng Manis',
            //     'produk_jenis' => 'Ayam',
            //     'produk_harga' => 25000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR025',
            //     'produk_nama' => 'Soto Ayam',
            //     'produk_jenis' => 'Soto',
            //     'produk_harga' => 15000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR026',
            //     'produk_nama' => 'Soto Babat',
            //     'produk_jenis' => 'Soto',
            //     'produk_harga' => 20000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR027',
            //     'produk_nama' => 'Soto Kulit',
            //     'produk_jenis' => 'Soto',
            //     'produk_harga' => 18000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR028',
            //     'produk_nama' => 'Soto Campur',
            //     'produk_jenis' => 'Soto',
            //     'produk_harga' => 25000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR029',
            //     'produk_nama' => 'Soto Paruh',
            //     'produk_jenis' => 'Soto',
            //     'produk_harga' => 22000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR030',
            //     'produk_nama' => 'Bebek Goreng',
            //     'produk_jenis' => 'Bebek',
            //     'produk_harga' => 25000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR031',
            //     'produk_nama' => 'Bebek Bakar',
            //     'produk_jenis' => 'Bebek',
            //     'produk_harga' => 30000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR032',
            //     'produk_nama' => 'Bebek Goreng Kremes',
            //     'produk_jenis' => 'Bebek',
            //     'produk_harga' => 27000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR033',
            //     'produk_nama' => 'Bebek Bakar Kremes',
            //     'produk_jenis' => 'Bebek',
            //     'produk_harga' => 32000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR034',
            //     'produk_nama' => 'Sate Usus',
            //     'produk_jenis' => 'Sate',
            //     'produk_harga' => 10000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR035',
            //     'produk_nama' => 'Sate Kulit',
            //     'produk_jenis' => 'Sate',
            //     'produk_harga' => 12000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR036',
            //     'produk_nama' => 'Sate Ati Ampela',
            //     'produk_jenis' => 'Sate',
            //     'produk_harga' => 15000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR037',
            //     'produk_nama' => 'Sate Telor Puyuh',
            //     'produk_jenis' => 'Sate',
            //     'produk_harga' => 8000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR038',
            //     'produk_nama' => 'Sate Babat',
            //     'produk_jenis' => 'Sate',
            //     'produk_harga' => 18000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR039',
            //     'produk_nama' => 'Sate Paruh',
            //     'produk_jenis' => 'Sate',
            //     'produk_harga' => 20000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR040',
            //     'produk_nama' => 'Sate Udang Goreng',
            //     'produk_jenis' => 'Sate',
            //     'produk_harga' => 25000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR041',
            //     'produk_nama' => 'Sate Udang Kremes',
            //     'produk_jenis' => 'Sate',
            //     'produk_harga' => 30000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR042',
            //     'produk_nama' => 'Telor Dadar',
            //     'produk_jenis' => 'Tambahan',
            //     'produk_harga' => 10000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR043',
            //     'produk_nama' => 'Tahu / Tempe',
            //     'produk_jenis' => 'Tambahan',
            //     'produk_harga' => 10000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR044',
            //     'produk_nama' => 'Telor Asin',
            //     'produk_jenis' => 'Tambahan',
            //     'produk_harga' => 12000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR045',
            //     'produk_nama' => 'Pete Goreng',
            //     'produk_jenis' => 'Tambahan',
            //     'produk_harga' => 15000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR046',
            //     'produk_nama' => 'Kol Goreng',
            //     'produk_jenis' => 'Tambahan',
            //     'produk_harga' => 10000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR047',
            //     'produk_nama' => 'Sambal Geprek',
            //     'produk_jenis' => 'Tambahan',
            //     'produk_harga' => 8000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR048',
            //     'produk_nama' => 'Paket Ayam',
            //     'produk_jenis' => 'Paket',
            //     'produk_harga' => 40000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR049',
            //     'produk_nama' => 'Paket Bebek',
            //     'produk_jenis' => 'Paket',
            //     'produk_harga' => 45000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR050',
            //     'produk_nama' => 'Paket Lele',
            //     'produk_jenis' => 'Paket',
            //     'produk_harga' => 35000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR051',
            //     'produk_nama' => 'Es Teh Manis / Terhangat',
            //     'produk_jenis' => 'Minuman',
            //     'produk_harga' => 5000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR052',
            //     'produk_nama' => 'Es Jeruk / Jeruk Hangat',
            //     'produk_jenis' => 'Minuman',
            //     'produk_harga' => 6000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR053',
            //     'produk_nama' => 'Fruit Tea',
            //     'produk_jenis' => 'Minuman',
            //     'produk_harga' => 8000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR054',
            //     'produk_nama' => 'Teh Botol',
            //     'produk_jenis' => 'Minuman',
            //     'produk_harga' => 5000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR055',
            //     'produk_nama' => 'S-Tea',
            //     'produk_jenis' => 'Minuman',
            //     'produk_harga' => 5000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR056',
            //     'produk_nama' => 'Tebs',
            //     'produk_jenis' => 'Minuman',
            //     'produk_harga' => 6000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR057',
            //     'produk_nama' => 'Aqua Dingin',
            //     'produk_jenis' => 'Minuman',
            //     'produk_harga' => 3000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            // [
            //     'produk_kode' => 'PR058',
            //     'produk_nama' => 'Lele Bakar',
            //     'produk_jenis' => 'Ikan',
            //     'produk_harga' => 15000,
            //     'produk_stok' => 0,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
