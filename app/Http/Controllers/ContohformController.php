<?php

namespace App\Http\Controllers;

use App\Models\Contohform;
use App\Models\Coa; //load model dari kelas model coa
use App\Models\Perusahaan; //load model dari kelas model perusahaan

use App\Http\Requests\StoreContohformRequest;
use App\Http\Requests\UpdateContohformRequest;

use Illuminate\Support\Facades\Storage; //tambahan 
use Illuminate\Support\Facades\File; //untuk hapus file

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContohformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mengambil data coa dan perusahaan dari database
    	$c = Contohform::getAllDocumentLists();

        return view('contohform/view',
            [
                'contohform' => $c
            ]
        );
    }

    // fect data contoh form
    public function fetchcontohform()
    {
        $c = Contohform::getAllDocumentLists();
        return response()->json([
            'contohform'=>$c,
        ]);
    }

    // handle fetch all coas ajax request
	public function fetchAll() {
		// $coas = Coa::all();
        $cf = Contohform::getAllDocumentLists();
		$output = '';
		if (count($cf) > 0) {
			$output .= '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Gambar</th>
                <th style="text-align: center">Tgl Rilis</th>
                <th>Klasifikasi</th>
                <th>Jenis Dokumen</th>
                <th>Hobi</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tfoot class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th style="text-align: center">Tgl Rilis</th>
                    <th>Klasifikasi</th>
                    <th>Jenis Dokumen</th>
                    <th>Hobi</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </tfoot>
            <tbody>';
			foreach ($cf as $c) {
                // Mendapatkan path lengkap ke direktori public
                $publicPath = url('gambar/');

                // Mendapatkan path lengkap ke gambar berdasarkan nama file
                $imagePath = $publicPath .'/'. $c->gambar_dokumen;


				$output .= '<tr>
                <td>' . $c->nama_dokumen . '</td>
                <td><a data-fancybox="gallery" href="'.$imagePath.'"><img width="150px" height="100px" id="x-'.$c->id.'" src="'.$imagePath.'"></a></td>
                <td>' . $c->tgl_rilis . '</td>
                <td>' . $c->klasifikasi_dokumen . '</td>
                <td>' . $c->list_dokumen . '</td>
                <td>' . $c->list_hobi . '</td>
                <td style="text-align: center">
                    <a href="#" onclick="updateConfirm(this); return false;" class="btn btn-success btn-icon-split btn-sm editbtn" value="'.$c->id.'" data-id="'.$c->id.'" ><span class="icon text-white-50"><i class="ti ti-pencil"></i></span></a>
                    <a href="#" onclick="deleteConfirm(this); return false;" href="#" value="'.$c->id.'" data-id="'.$c->id.'" class="btn btn-danger btn-icon-split btn-sm deletebtn"><span class="icon text-white-50"><i class="ti ti-trash"></i></span>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContohformRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContohformRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'nama_dokumen' => 'required|min:3',
                'tgl_rilis' => 'required',
                'klasifikasi_dokumen' => 'required',
                'gambar_dokumen' => 'file|image|mimes:jpeg,png,jpg|max:2048'
            ]
        );
        
        if($validator->fails()){
            // gagal
            return response()->json(
                [
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]
            );
        }else{
            // berhasil

            // cek apakah tipenya input atau update
            // input => tipeproses isinya adalah tambah
            // update => tipeproses isinya adalah ubah
            
            if($request->input('tipeproses')=='tambah'){

                $file = $request->file('gambar_dokumen');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $tujuan_upload = 'gambar';
		        $file->move($tujuan_upload,$fileName);

                $empData = ['nama_dokumen' => $request->input('nama_dokumen'), 'gambar_dokumen' => $fileName, 'tgl_rilis' => $request->input('tgl_rilis'), 'klasifikasi_dokumen' => $request->input('klasifikasi_dokumen')];
		        Contohform::create($empData);

                // pemrosesan jenis dokumen
                $jd = $request->input('jenis_dok');
                // dapatkan id terakhir setelah diinputkan
                $l = Contohform::getLastId();
                $idmaks = $l[0]->mak_id; //dapatkan id terakhir dan simpan ke idmaks
                
                // masukkan setiap data jenis dokumen dari select2
                foreach ($jd as $value) {
                    // masukkan ke db
                    Contohform::inputJenisDokumen($idmaks, $value);
                }

                // proses checkbox
                $renang = $request->input('renang');
                if(isset($renang)){
                    // masukkan ke db
                    Contohform::inputHobi($idmaks, $renang);
                }
                $musik = $request->input('musik');
                if(isset($musik)){
                    // masukkan ke db
                    Contohform::inputHobi($idmaks, $musik);
                }
                $tidur = $request->input('tidur');
                if(isset($tidur)){
                    // masukkan ke db
                    Contohform::inputHobi($idmaks, $tidur);
                }
                
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }else{
                // update ke db
                // cek dulu jika ada file yg diupload lagi maka prosedur input image dilakukan lagi
                if($request->hasFile('gambar_dokumen')){ 
                    // jalankan prosedur upload ke server
                    $file = $request->file('gambar_dokumen');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $tujuan_upload = 'gambar';
                    $file->move($tujuan_upload,$fileName);

                    // update ke db
                    $c = Contohform::find($request->input('idcontohformhidden'));
                
                    // proses update dari inputan form data
                    $c->nama_dokumen = $request->input('nama_dokumen');
                    $c->gambar_dokumen = $fileName;
                    $c->tgl_rilis = $request->input('tgl_rilis');
                    $c->klasifikasi_dokumen = $request->input('klasifikasi_dokumen');
                    $c->update(); //proses update ke db

                }else{
                    // kalau tidak maka nilainya tidak perlu di update
                    // update ke db
                    // dapatkan record yang mau diupdate berdasarkan idnya
                    $c = Contohform::find($request->input('idcontohformhidden'));
                
                    // proses update dari inputan form data
                    $c->nama_dokumen = $request->input('nama_dokumen');
                    $c->gambar_dokumen = $request->input('namadokumenlama');
                    $c->tgl_rilis = $request->input('tgl_rilis');
                    $c->klasifikasi_dokumen = $request->input('klasifikasi_dokumen');
                    $c->update(); //proses update ke db
                }

                // hapus dulu baru masukin lagi
                Contohform::delHobiJenisDokumen($request->input('idcontohformhidden'));

                // masukin lagi jenis dokumen
                $jd = $request->input('jenis_dok');
                foreach ($jd as $value) {
                    // masukkan ke db
                    Contohform::inputJenisDokumen($request->input('idcontohformhidden'), $value);
                }

                // proses checkbox hobi
                $renang = $request->input('renang');
                if(isset($renang)){
                    // masukkan ke db
                    Contohform::inputHobi($request->input('idcontohformhidden'), $renang);
                }
                $musik = $request->input('musik');
                if(isset($musik)){
                    // masukkan ke db
                    Contohform::inputHobi($request->input('idcontohformhidden'), $musik);
                }
                $tidur = $request->input('tidur');
                if(isset($tidur)){
                    // masukkan ke db
                    Contohform::inputHobi($request->input('idcontohformhidden'), $tidur);
                }

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'update data',
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contohform  $contohform
     * @return \Illuminate\Http\Response
     */
    public function show(Contohform $contohform)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contohform  $contohform
     * @return \Illuminate\Http\Response
     */
    // public function edit(Contohform $contohform)
    public function edit($id)
    {
        $c = Contohform::getAllDocumentListsByIdDokumen($id);
        if($c)
        {
            return response()->json([
                'status'=>200,
                'c'=> $c,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContohformRequest  $request
     * @param  \App\Models\Contohform  $contohform
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContohformRequest $request, Contohform $contohform)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contohform  $contohform
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Contohform $contohform)
    public function destroy($id)
    {
        //hapus dari database
        $c = Contohform::findOrFail($id);

        // hapus file
        $pathfile = public_path('gambar/' .$c->gambar_dokumen);
        File::delete($pathfile);
        // hapus record di database
        $c->delete();

        // hapus anaknya
        Contohform::delHobiJenisDokumen($id);

        return view('contohform/view',
            [
                'contohform' => $c,
                'status_hapus' => 'Sukses Hapus '
            ]
        );
    }
}