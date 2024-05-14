<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BahanbakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bahanbaku')->insert([
            ['bahanbaku_kode' => 'BB001', 'bahanbaku_nama' => 'Ikan Gurami', 'bahanbaku_jenis' => 'Ikan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB002', 'bahanbaku_nama' => 'Ikan Lele', 'bahanbaku_jenis' => 'Ikan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB003', 'bahanbaku_nama' => 'Ikan Nila', 'bahanbaku_jenis' => 'Ikan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB004', 'bahanbaku_nama' => 'Ikan Bawal', 'bahanbaku_jenis' => 'Ikan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB005', 'bahanbaku_nama' => 'Ayam', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB006', 'bahanbaku_nama' => 'Udang', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB007', 'bahanbaku_nama' => 'Bebek', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB008', 'bahanbaku_nama' => 'Babat', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB009', 'bahanbaku_nama' => 'Paruh', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB010', 'bahanbaku_nama' => 'Telur Puyuh', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB011', 'bahanbaku_nama' => 'Telur Asin', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB012', 'bahanbaku_nama' => 'Kulit', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB013', 'bahanbaku_nama' => 'Telur', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB014', 'bahanbaku_nama' => 'Usus', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB015', 'bahanbaku_nama' => 'Ati Ampela', 'bahanbaku_jenis' => 'Daging/ Jeroan', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB016', 'bahanbaku_nama' => 'Tahu', 'bahanbaku_jenis' => 'Protein Nabati', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB017', 'bahanbaku_nama' => 'Tempe', 'bahanbaku_jenis' => 'Protein Nabati', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB018', 'bahanbaku_nama' => 'Santan', 'bahanbaku_jenis' => 'Bumbu', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB019', 'bahanbaku_nama' => 'Penyedap Rasa', 'bahanbaku_jenis' => 'Bumbu', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB020', 'bahanbaku_nama' => 'Cabai', 'bahanbaku_jenis' => 'Bumbu', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB021', 'bahanbaku_nama' => 'Bawang Putih', 'bahanbaku_jenis' => 'Bumbu', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB022', 'bahanbaku_nama' => 'Bawang Merah', 'bahanbaku_jenis' => 'Bumbu', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB023', 'bahanbaku_nama' => 'Garam', 'bahanbaku_jenis' => 'Bumbu', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB024', 'bahanbaku_nama' => 'Kecap', 'bahanbaku_jenis' => 'Bumbu', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB025', 'bahanbaku_nama' => 'Gula Merah', 'bahanbaku_jenis' => 'Bumbu', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB026', 'bahanbaku_nama' => 'Gula', 'bahanbaku_jenis' => 'Bumbu', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB027', 'bahanbaku_nama' => 'Beras', 'bahanbaku_jenis' => 'Bahan Pokok', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB028', 'bahanbaku_nama' => 'Timun', 'bahanbaku_jenis' => 'Sayur', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB029', 'bahanbaku_nama' => 'Selada', 'bahanbaku_jenis' => 'Sayur', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB030', 'bahanbaku_nama' => 'Kemangi', 'bahanbaku_jenis' => 'Sayur', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB031', 'bahanbaku_nama' => 'Kol', 'bahanbaku_jenis' => 'Sayur', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB032', 'bahanbaku_nama' => 'Toge', 'bahanbaku_jenis' => 'Sayur', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB033', 'bahanbaku_nama' => 'Tomat', 'bahanbaku_jenis' => 'Sayur', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB034', 'bahanbaku_nama' => 'Pete', 'bahanbaku_jenis' => 'Sayur', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB035', 'bahanbaku_nama' => 'Tepung', 'bahanbaku_jenis' => 'Bahan Pendukung', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB036', 'bahanbaku_nama' => 'Air', 'bahanbaku_jenis' => 'Bahan Pendukung', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB037', 'bahanbaku_nama' => 'Minyak Goreng', 'bahanbaku_jenis' => 'Bahan Pendukung', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB038', 'bahanbaku_nama' => 'Tusuk Sate', 'bahanbaku_jenis' => 'Bahan Pendukung', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB039', 'bahanbaku_nama' => 'Fruit Tea', 'bahanbaku_jenis' => 'Minuman', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB040', 'bahanbaku_nama' => 'Teh Botol', 'bahanbaku_jenis' => 'Minuman', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB041', 'bahanbaku_nama' => 'S-Tea', 'bahanbaku_jenis' => 'Minuman', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB042', 'bahanbaku_nama' => 'Tebs', 'bahanbaku_jenis' => 'Minuman', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['bahanbaku_kode' => 'BB043', 'bahanbaku_nama' => 'Aqua', 'bahanbaku_jenis' => 'Minuman', 'bahanbaku_stok' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
