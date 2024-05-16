<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketSoalEssayDtl extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "paket_soal_essay_dtl";
    protected $guarded = ["id"];

    public function master_soal_essay_r()
    {
        return $this->belongsTo(MasterSoalEssay::class, 'fk_master_soal_essay', 'id');
    }
}
