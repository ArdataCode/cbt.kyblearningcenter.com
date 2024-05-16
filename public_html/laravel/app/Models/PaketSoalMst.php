<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketSoalMst extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "paket_soal_mst";
    protected $guarded = ["id"];

    public function paket_soal_dtl_r()
    {
        return $this->hasMany(PaketSoalDtl::class, 'fk_paket_soal_mst', 'id');
    }
    public function paket_soal_essay_dtl_r()
    {
        return $this->hasMany(PaketSoalEssayDtl::class, 'fk_paket_soal_mst', 'id');
    }

    public function getNamaJenisPenilaianAttribute() {
        if ($this->jenis_penilaian==1) {
            return "Rata-rata";
        }else if($this->jenis_penilaian==2){
            return "Point";
        }
    }

}
