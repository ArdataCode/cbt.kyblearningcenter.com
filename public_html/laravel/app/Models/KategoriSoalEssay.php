<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriSoalEssay extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "kategori_soal_essay";
    protected $guarded = ["id"];
}
