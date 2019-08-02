<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CalculateC45;
use App\C45;
use Carbon\Carbon;
use DB;

class CalculateC45Controller extends Controller
{
  public function index(Request $request)
  {
    $que = CalculateC45::orderBy('no_peg','ASC')->get();
    $data = [];
    if(!$que->isEmpty()){
      foreach ($que as $value) {

        $data[] = array(
          'no_peg' => $value->no_peg,
          'name' => $value->c45->name,
          'epr1' => $value->avg_epr1.' ('.$this->getStatString($value->status1).')',
          'epr2' => $value->avg_epr2.' ('.$this->getStatString($value->status2).')',
          'epr3' => $value->avg_epr3.' ('.$this->getStatString($value->status3).')',
          'epr4' => $value->avg_epr4.' ('.$this->getStatString($value->status4).')',
          'status' => $value->result
        );

      }

    }

    return view('c45.calculate',['data'=>$data]);
  }

  public function generate(Request $request)
  {

      $truncate = CalculateC45::truncate();

      $c45 = C45::selectRaw('SUM(epr1) as sum_epr1,SUM(epr2) as sum_epr2,SUM(epr3) as sum_epr3,SUM(epr4) as sum_epr4, no_peg, COUNT(year) as cnt_year');
      $c45 = $c45->groupBy('no_peg')->get();

      if(!$c45->isEmpty()){
        foreach ($c45 as $value) {
          $paramStatus = [];

          $sum1 = round($value->sum_epr1/$value->cnt_year,2);
          $status1 = $this->getStat($sum1);
          $paramStatus[] = $status1;

          $sum2 = round($value->sum_epr2/$value->cnt_year,2);
          $status2 = $this->getStat($sum2);
          $paramStatus[] = $status2;

          $sum3 = round($value->sum_epr3/$value->cnt_year,2);
          $status3 = $this->getStat($sum3);
          $paramStatus[] = $status3;

          $sum4 = round($value->sum_epr4/$value->cnt_year,2);
          $status4 = $this->getStat($sum4);
          $paramStatus[] = $status4;
          
          $result = $this->getResult($paramStatus);

          $save = new CalculateC45;
          $save->no_peg = $value->no_peg;
          $save->avg_epr1 = $sum1;
          $save->avg_epr2 = $sum2;
          $save->avg_epr3 = $sum3;
          $save->avg_epr4 = $sum4;
          $save->status1 = $status1;
          $save->status2 = $status2;
          $save->status3 = $status3;
          $save->status4 = $status4;
          $save->result = $result;
          $save->save();
        }
      }

      return redirect('calculate');
  }

  public function getStat($nilai)
  {
    if($nilai < 3){
      $status = 1;
    }elseif($nilai >= 3 && $nilai < 4){
      $status = 2;
    }elseif($nilai >= 4 && $nilai < 5){
      $status = 3;
    }else{
      $status = 4;
    }

    return $status;

  }

  public function getStatString($nilai)
  {
    if($nilai == 1){
      $string_status = "Kurang Baik";
    }elseif($nilai == 2){
      $string_status = "Cukup Baik";
    }elseif($nilai == 3){
      $string_status = "Baik";
    }else{
      $string_status = "Sangat Baik";
    }

    return $string_status;
  }

  public function getResult($param=[])
  {
    $result = 1;
    if(!empty($param)){
      $counts = array_count_values($param);
      if(!empty($counts)){
        if(isset($counts['1'])?$counts['1']:0 > 0){
          $result=2;
        }elseif(isset($counts['2'])?$counts['2']:0 >= 2){
          $result = 1;
        }
      }
    }

    return $result;

  }

}
