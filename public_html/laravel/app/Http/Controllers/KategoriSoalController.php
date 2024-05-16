<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriSoal;
use App\Models\PaketSoalKtg;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Crypt;

class KategoriSoalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menu = 'master';
        $submenu='kategorisoal';
        $data = KategoriSoal::all();
        $data_param = [
            'menu','submenu','data'
        ];

        return view('master/kategorisoal')->with(compact($data_param));
    }
    public function store(Request $request)
    {
        $data['judul'] = $request->judul_add;
        $data['ket'] = $request->ket_add;
        $data['created_by'] = Auth::id();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        $createdata = KategoriSoal::create($data);
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

    public function update(Request $request, $id)
    {
        $data['judul'] = $request->judul[0];
        $data['ket'] = $request->ket[0];
        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        $updatedata = KategoriSoal::find($id)->update($data);

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
        $cekdata = PaketSoalKtg::where('fk_kategori_soal',$id)->first();
        if(!$cekdata){
            $data['deleted_by'] = Auth::id();
            $data['deleted_at'] = Carbon::now()->toDateTimeString();
            $updateData = KategoriSoal::find($id)->update($data);
        }
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
