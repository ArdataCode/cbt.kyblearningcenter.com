<?php

namespace App\Imports;

use App\Models\MasterSoalEssay;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Auth;
use Carbon\Carbon;

class SoalEssayImport implements ToModel ,WithStartRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    private $data; 

    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }

    public function model(array $row)
    {
        $fk_kategori_soal_essay = $this->data['fk_kategori_soal_essay'];
        
            return new MasterSoalEssay([
                'fk_kategori_soal_essay'     => $fk_kategori_soal_essay,
                'soal'     => $row[0],
                'jawaban'    => strtolower($row[1]),
                'point'     => $row[2],
                'created_by'    => Auth::id(), 
                'created_at'    => Carbon::now()->toDateTimeString(),
                'updated_by'    => Auth::id(), 
                'updated_at'    => Carbon::now()->toDateTimeString(),  
            ]);
        // }
    }
    public function startRow(): int
    {
        return 2;
    }

    public function onError(\Throwable $error)
    {
        // Handle the exception how you'd like.
    }
}
