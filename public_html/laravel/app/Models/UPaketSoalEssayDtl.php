<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UPaketSoalEssayDtl extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "u_paket_soal_essay_dtl";
    protected $guarded = ["id"];

    // public function u_mapel_mst_r()
    // {
    //     return $this->belongsTo(UMapelMst::class, 'fk_u_paket_soal_mst', 'id');
    // }

    public function u_paket_soal_ktg_r()
    {
        return $this->belongsTo(UPaketSoalEssayKtg::class, 'fk_u_paket_soal_ktg', 'id');
    }
}
