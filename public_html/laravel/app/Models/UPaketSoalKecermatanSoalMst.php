<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UPaketSoalKecermatanSoalMst extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "u_paket_soal_kecermatan_soal_mst";
    protected $guarded = ["id"];

    public function u_paket_soal_kecermatan_soal_dtl_r()
    {
        return $this->hasMany(UPaketSoalKecermatanSoalDtl::class, 'fk_u_paket_soal_kecermatan_soal_mst', 'id');
    }
    
}
