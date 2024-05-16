<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterSoalEssay;
use App\Models\KategoriSoalEssay;
use App\Models\User;
use App\Models\PaketSoalEssayDtl;
use App\Imports\SoalEssayImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Crypt;

class MasterSoalEssayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($idkategori)
    {
        $menu = 'master';
        $submenu='kategorisoalessay';
        $data = MasterSoalEssay::where('fk_kategori_soal_essay',$idkategori)->get();
        $datakategori = KategoriSoalEssay::find($idkategori);
        $data_param = [
            'menu','submenu','data','idkategori','datakategori'
        ];

        return view('master/mastersoalessay')->with(compact($data_param));
    }

    public function store(Request $request)
    {
        $data['fk_kategori_soal_essay'] = $request->fk_kategori_soal_essay_add;
        $data['soal'] = $request->soal_add;
        $data['jawaban'] = $request->jawaban_add;
        $data['point'] = $request->point_add;

        // if ($data['soal']=='' || $data['a']=='' || $data['b']=='' || $data['c']=='' || $data['d']=='' || $data['e']=='' || $data['jawaban']=='' || $data['pembahasan']=='') {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Semua kolom harus diisi!'
        //     ]);
        //     exit();
        // }

        $data['created_by'] = Auth::id();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        $createdata = MasterSoalEssay::create($data);
        if($createdata){
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menambahkan data'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Gagal. Mohon coba kembali!'
            ]);
        }
    }

    public function edit($idkategori,$idsoal)
    {
        $menu = 'master';
        $submenu='kategorisoalessay';
        $data = MasterSoalEssay::find($idsoal);
        $datakategori = KategoriSoalEssay::find($idkategori);
        $data_param = [
            'menu','submenu','data','idkategori','datakategori'
        ];

        return view('master/editsoalessay')->with(compact($data_param));
    }

    public function update(Request $request, $id)
    {
        $data['soal'] = $request->soal[0];
        // $data['tingkat'] = $request->tingkat_edit;
        // $data['a'] = $request->a[0];
        // $data['b'] = $request->b[0];
        // $data['c'] = $request->c[0];
        // $data['d'] = $request->d[0];
        // $data['e'] = $request->e[0];
        // $data['point_a'] = $request->point_a[0];
        // $data['point_b'] = $request->point_b[0];
        // $data['point_c'] = $request->point_c[0];
        // $data['point_d'] = $request->point_d[0];
        // $data['point_e'] = $request->point_e[0];
        
        $data['jawaban'] = $request->jawaban[0];
        $data['point'] = $request->point[0];
        // $data['pembahasan'] = $request->pembahasan[0];

        // if ($data['soal']=='' || $data['a']=='' || $data['b']=='' || $data['c']=='' || $data['d']=='' || $data['e']=='' || $data['jawaban']=='' || $data['pembahasan']=='') {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Semua kolom harus diisi!'
        //     ]);
        //     exit();
        // }
        
        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        $updatedata = MasterSoalEssay::find($id)->update($data);

        if($updatedata){
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Gagal. Mohon coba kembali!'
            ]);
        }
    }

    public function destroy($id)
    {
        $data['deleted_by'] = Auth::id();
        $data['deleted_at'] = Carbon::now()->toDateTimeString();
        $updateData = MasterSoalEssay::find($id)->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function destroyall(Request $request)
    {
        foreach($request->idsoal as $key){
            $cekdata = PaketSoalEssayDtl::where('fk_master_soal_essay',$key)->first();
            if(!$cekdata){
                $data['deleted_by'] = Auth::id();
                $data['deleted_at'] = Carbon::now()->toDateTimeString();
                $updateData = MasterSoalEssay::find($key)->update($data);
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function importsoal(Request $request)
    {
        $idkategori = $request->idkategori;
        $data = [
            'fk_kategori_soal_essay' => $idkategori, 
        ]; 
        Excel::import(new SoalEssayImport($data), request()->file('fileexcel'));
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diimport'
        ]);
    }
}
