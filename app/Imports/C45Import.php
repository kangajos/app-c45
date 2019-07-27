<?php

namespace App\Imports;

use App\C45;
use Maatwebsite\Excel\Concerns\ToModel;

class C45Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row[0]) && is_numeric($row[0])){
            $bod = explode('.',$row[10]);
            $join = explode('.',$row[12]);
            return new C45([
                'no_peg' => $row[1],
                'year' => $row[0],
                'name' => $row[2],
                'code' => $row[3],
                'code_text' => $row[4],
                'gender' => ($row[5]=="Male")?0:1,
                'persg' => ($row[6]=='PHK')?1:0,
                'persk' => $row[7],
                'ctr' => $row[8],
                'ctr_text' => $row[9],
                'birth_date' => (count($bod) > 2) ? $bod[2].'-'.$bod[1].'-'.$bod[0] : null,
                'age' => str_replace(",",".",$row[11]),
                'join_date' => (count($join) > 2) ? $join[2].'-'.$join[1].'-'.$join[0] : null,
                'position' => $row[13],
                'position_text' => $row[14],
                'epr1' => $row[15],
                'epr2' => $row[16],
                'epr3' => $row[17],
                'epr4' => $row[18],
            ]);
        }
    }
}
