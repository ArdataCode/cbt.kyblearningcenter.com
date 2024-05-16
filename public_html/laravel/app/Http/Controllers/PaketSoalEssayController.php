<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KategoriSoalEssay;
use App\Models\PaketSoalMst;
use App\Models\UMapelMst;
use App\Models\PaketHadiah;
use App\Models\PaketSoalDtl;
use App\Models\PaketSoalEssayDtl;
use App\Models\PaketSoalEssayKtg;
use App\Models\MasterSoalEssay;
use Carbon\Carbon;
use Auth;
use DB;
use Illuminate\Support\Facades\Crypt;

class PaketSoalEssayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexktg($idpaketmst)
    {
        $menu = 'master';
        $submenu='paketsoalmst';
        $datamst = PaketSoalMst::find($idpaketmst);
        $arr = PaketSoalEssayKtg::where('fk_paket_soal_mst',$idpaketmst)->pluck('fk_kategori_soal')->all(); 
        $ktgsoal = KategoriSoalEssay::whereNotIn('id',$arr)->get();
        $data = PaketSoalEssayKtg::where('fk_paket_soal_mst',$idpaketmst)->orderBy('created_at','desc')->get();
        $data_param = [
            'menu','submenu','data','ktgsoal','idpaketmst','datamst'
        ];
        return view('master/paketsoalessayktg')->with(compact($data_param));
    }

    public function storektg(Request $request)
    {
        $data['fk_paket_soal_mst'] = $request->fk_paket_soal_mst;
        $data['fk_kategori_soal'] = $request->fk_kategori_soal_add;

        $cekdata = PaketSoalEssayKtg::where('fk_paket_soal_mst',$request->fk_paket_soal_mst)->where('fk_kategori_soal',$request->fk_kategori_soal_add)->first();
        if($cekdata){
            return response()->json([
                'status' => false,
                'message' => 'Kategori soal sudah ada pada paket ini, silahkan isi kategori lainnya!'
            ]);
            dd('Error');
        }
        // $data['kkm'] = $request->kkm_add;
        $data['created_by'] = Auth::id();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        $createdata = PaketSoalEssayKtg::create($data);
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
    public function updatektg(Request $request, $id)
    {
        $data['kkm'] = $request->kkm[0];
        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        $updatedata = PaketSoalEssayKtg::find($id)->update($data);

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
    public function destroyktg($id)
    {
        $getdata = PaketSoalEssayKtg::find($id);
        $data['deleted_by'] = Auth::id();
        $data['deleted_at'] = Carbon::now()->toDateTimeString();
        $updateData = PaketSoalEssayKtg::find($id)->update($data);
        $updateData = PaketSoalEssayDtl::where('fk_paket_soal_essay_ktg',$id)->update($data);

        $totalsoal_pilgan = count(PaketSoalDtl::where('fk_paket_soal_mst', $getdata->fk_paket_soal_mst)->get());
        $totalsoal_essay = count(PaketSoalEssayDtl::where('fk_paket_soal_mst', $getdata->fk_paket_soal_mst)->get());
        $updatedatamst['total_soal'] = $totalsoal_pilgan + $totalsoal_essay;
// 
        // $updatedatamst['total_soal'] = count(PaketSoalEssayDtl::where('fk_paket_soal_mst', $getdata->fk_paket_soal_mst)->get());
        PaketSoalMst::find($getdata->fk_paket_soal_mst)->update($updatedatamst);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function indexdtl($idpaketsoalktg)
    {
        $menu = 'master';
        $submenu='paketsoalmst';
        $data = PaketSoalEssayKtg::find($idpaketsoalktg); 
        $mastersoal = MasterSoalEssay::where('fk_kategori_soal_essay',$data->fk_kategori_soal)->get();
        $data_param = [
            'menu','submenu','data','mastersoal','idpaketsoalktg'
        ];
        return view('master/paketsoalessaydtl')->with(compact($data_param));
    }

    public function storedtl(Request $request ,$idmst, $idktg)
    {
       
        if($request->id_master_soal){
            PaketSoalEssayDtl::where('fk_paket_soal_mst',$idmst)->where('fk_paket_soal_essay_ktg', $idktg)->forceDelete();
            foreach ($request->id_master_soal as $key) {
                $data['fk_master_soal_essay'] = $key;
                $data['fk_paket_soal_mst'] = $idmst;
                $data['fk_paket_soal_essay_ktg'] = $idktg;
                $data['created_by'] = Auth::id();
                $data['created_at'] = Carbon::now()->toDateTimeString();
                $data['updated_by'] = Auth::id();
                $data['updated_at'] = Carbon::now()->toDateTimeString();
                PaketSoalEssayDtl::create($data);
            } 
            $updatedataktg['jumlah_soal'] = count(PaketSoalEssayDtl::where('fk_paket_soal_essay_ktg', $idktg)->get());
            PaketSoalEssayKtg::find($idktg)->update($updatedataktg);

            $totalsoal_pilgan = count(PaketSoalDtl::where('fk_paket_soal_mst', $idmst)->get());
            $totalsoal_essay = count(PaketSoalEssayDtl::where('fk_paket_soal_mst', $idmst)->get());
            $updatedatamst['total_soal'] = $totalsoal_pilgan + $totalsoal_essay;
            PaketSoalMst::find($idmst)->update($updatedatamst);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Soal belum dipilih'
            ]);
        }
    }




    
}
