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

  public function result()
  {

    $gender = CalculateC45::selectRaw("gender,COUNT(gender) as cnt_gend,
    SUM(if(result = '1', 1, 0)) AS cnt_rekom,
    SUM(if(result = '2', 1, 0)) AS cnt_usul");
    $gender = $gender->join('c45','c45.no_peg','=','calculate_c45.no_peg');
    $gender = $gender->groupBy('gender')->get();

    $epr1 = CalculateC45::selectRaw("status1,
    COUNT(status1) as cnt_res,
      SUM(if(result = '1', 1, 0)) AS cnt_rekom,
      SUM(if(result = '2', 1, 0)) AS cnt_usul");
    $epr1 = $epr1->groupBy('status1')->get();

    $epr2 = CalculateC45::selectRaw("status2,
    COUNT(status2) as cnt_res,
      SUM(if(result = '1', 1, 0)) AS cnt_rekom,
      SUM(if(result = '2', 1, 0)) AS cnt_usul");
    $epr2 = $epr2->groupBy('status2')->get();

    $epr3 = CalculateC45::selectRaw("status3,
    COUNT(status3) as cnt_res,
      SUM(if(result = '1', 1, 0)) AS cnt_rekom,
      SUM(if(result = '2', 1, 0)) AS cnt_usul");
    $epr3 = $epr3->groupBy('status3')->get();

    $epr4 = CalculateC45::selectRaw("status4,
    COUNT(status4) as cnt_res,
      SUM(if(result = '1', 1, 0)) AS cnt_rekom,
      SUM(if(result = '2', 1, 0)) AS cnt_usul");
    $epr4 = $epr4->groupBy('status4')->get();

    $total = 0;
    $total_rekom = 0;
    $total_usul = 0;

    $result = array(
      'gender' => array(
        'Male' => array(
          'gender' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Female' => array(
          'gender' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        )
      ),
      'epr1' => array(
        'Kurang Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Cukup Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Sangat Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        )
      ),
      'epr2' => array(
        'Kurang Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Cukup Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Sangat Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        )
      ),
      'epr3' => array(
        'Kurang Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Cukup Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Sangat Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        )
      ),
      'epr4' => array(
        'Kurang Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Cukup Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        ),
        'Sangat Baik' => array(
          'count' => 0,
          'rekom' => 0,
          'usul' => 0,
          'entropy' => 0
        )
      )
    );

    if(!$gender->isEmpty()){
      foreach ($gender as $value) {
        $total += $value->cnt_gend;
        $total_rekom += $value->cnt_rekom;
        $total_usul += $value->cnt_usul;

        $par = ($value->gender==0)? 'Male' : 'Female';

        $log1 = ($value->cnt_rekom/$value->cnt_gend > 0) ? log(($value->cnt_rekom/$value->cnt_gend),2) : 0;
        $log2 = ($value->cnt_usul/$value->cnt_gend > 0) ? log(($value->cnt_usul/$value->cnt_gend),2) : 0;
        
        $entropy = ((-$value->cnt_rekom/$value->cnt_gend)*$log1+(-$value->cnt_usul/$value->cnt_gend)*$log2);
        $result['gender'][$par] = array(
          'gender' => $value->cnt_gend,
          'rekom' => $value->cnt_rekom,
          'usul' => $value->cnt_usul,
          'entropy' => $entropy
        );
      }
    }

    if(!$epr1->isEmpty()){
      foreach ($epr1 as $value) {
        $par = 'Kurang Baik';
        if($value->status1 == 2){
          $par = 'Cukup Baik';
        }elseif($value->status1==3){
          $par = 'Baik';
        }elseif($value->status1==4){
          $par = 'Sangat Baik';
        }
        
        $log1 = ($value->cnt_rekom/$value->cnt_res > 0) ? log(($value->cnt_rekom/$value->cnt_res),2) : 0;
        $log2 = ($value->cnt_usul/$value->cnt_res > 0) ? log(($value->cnt_usul/$value->cnt_res),2) : 0;
        
        $entropy = ((-$value->cnt_rekom/$value->cnt_res)*$log1+(-$value->cnt_usul/$value->cnt_res)*$log2);
        $result['epr1'][$par] = array(
          'count' => $value->cnt_res,
          'rekom' => $value->cnt_rekom,
          'usul' => $value->cnt_usul,
          'entropy' => $entropy
        );
      }
    }

    if(!$epr2->isEmpty()){
      foreach ($epr2 as $value) {
        $par = 'Kurang Baik';
        if($value->status2 == 2){
          $par = 'Cukup Baik';
        }elseif($value->status2==3){
          $par = 'Baik';
        }elseif($value->status2==4){
          $par = 'Sangat Baik';
        }

        $log1 = ($value->cnt_rekom/$value->cnt_res > 0) ? log(($value->cnt_rekom/$value->cnt_res),2) : 0;
        $log2 = ($value->cnt_usul/$value->cnt_res > 0) ? log(($value->cnt_usul/$value->cnt_res),2) : 0;

        $entropy = ((-$value->cnt_rekom/$value->cnt_res)*$log1+(-$value->cnt_usul/$value->cnt_res)*$log2);
        $result['epr2'][$par] = array(
          'count' => $value->cnt_res,
          'rekom' => $value->cnt_rekom,
          'usul' => $value->cnt_usul,
          'entropy' => $entropy
        );
      }
    }

    if(!$epr3->isEmpty()){
      foreach ($epr3 as $value) {
        $par = 'Kurang Baik';
        if($value->status3 == 2){
          $par = 'Cukup Baik';
        }elseif($value->status3==3){
          $par = 'Baik';
        }elseif($value->status3==4){
          $par = 'Sangat Baik';
        }

        $log1 = ($value->cnt_rekom/$value->cnt_res > 0) ? log(($value->cnt_rekom/$value->cnt_res),2) : 0;
        $log2 = ($value->cnt_usul/$value->cnt_res > 0) ? log(($value->cnt_usul/$value->cnt_res),2) : 0;

        $entropy = ((-$value->cnt_rekom/$value->cnt_res)*$log1+(-$value->cnt_usul/$value->cnt_res)*$log2);
        $result['epr3'][$par] = array(
          'count' => $value->cnt_res,
          'rekom' => $value->cnt_rekom,
          'usul' => $value->cnt_usul,
          'entropy' => $entropy
        );
      }
    }

    if(!$epr4->isEmpty()){
      foreach ($epr4 as $value) {
        $par = 'Kurang Baik';
        if($value->status4 == 2){
          $par = 'Cukup Baik';
        }elseif($value->status4==3){
          $par = 'Baik';
        }elseif($value->status4==4){
          $par = 'Sangat Baik';
        }

        $log1 = ($value->cnt_rekom/$value->cnt_res > 0) ? log(($value->cnt_rekom/$value->cnt_res),2) : 0;
        $log2 = ($value->cnt_usul/$value->cnt_res > 0) ? log(($value->cnt_usul/$value->cnt_res),2) : 0;

        $entropy = ((-$value->cnt_rekom/$value->cnt_res)*$log1+(-$value->cnt_usul/$value->cnt_res)*$log2);
        $result['epr4'][$par] = array(
          'count' => $value->cnt_res,
          'rekom' => $value->cnt_rekom,
          'usul' => $value->cnt_usul,
          'entropy' => $entropy
        );
      }
    }

    $log1 = ($total_rekom/$total > 0) ? log(($total_rekom/$total),2) : 0;
    $log2 = ($total_usul/$total > 0) ? log(($total_usul/$total),2) : 0;

    $entropy = ((-$total_rekom/$total)*$log1+(-$total_usul/$total)*$log2);

    $result['total'] = array(
      'total' => $total,
      'rekom' => $total_rekom,
      'usul' => $total_usul,
      'entropy' => $entropy
    );

    $gain_gender = ($entropy) - (($result['gender']['Male']['gender']/$total)*$result['gender']['Male']['entropy']) - (($result['gender']['Female']['gender']/$total)*$result['gender']['Female']['entropy']);
    $gain_epr1 = ($entropy) - (($result['epr1']['Kurang Baik']['count']/$total)*$result['epr1']['Kurang Baik']['entropy']) - (($result['epr1']['Cukup Baik']['count']/$total)*$result['epr1']['Cukup Baik']['entropy']) - (($result['epr1']['Baik']['count']/$total)*$result['epr1']['Baik']['entropy']) - (($result['epr1']['Sangat Baik']['count']/$total)*$result['epr1']['Sangat Baik']['entropy']);
    $gain_epr2 = ($entropy) - (($result['epr2']['Kurang Baik']['count']/$total)*$result['epr2']['Kurang Baik']['entropy']) - (($result['epr2']['Cukup Baik']['count']/$total)*$result['epr2']['Cukup Baik']['entropy']) - (($result['epr2']['Baik']['count']/$total)*$result['epr2']['Baik']['entropy']) - (($result['epr2']['Sangat Baik']['count']/$total)*$result['epr2']['Sangat Baik']['entropy']);
    $gain_epr3 = ($entropy) - (($result['epr3']['Kurang Baik']['count']/$total)*$result['epr3']['Kurang Baik']['entropy']) - (($result['epr3']['Cukup Baik']['count']/$total)*$result['epr3']['Cukup Baik']['entropy']) - (($result['epr3']['Baik']['count']/$total)*$result['epr3']['Baik']['entropy']) - (($result['epr3']['Sangat Baik']['count']/$total)*$result['epr3']['Sangat Baik']['entropy']);
    $gain_epr4 = ($entropy) - (($result['epr4']['Kurang Baik']['count']/$total)*$result['epr4']['Kurang Baik']['entropy']) - (($result['epr4']['Cukup Baik']['count']/$total)*$result['epr4']['Cukup Baik']['entropy']) - (($result['epr4']['Baik']['count']/$total)*$result['epr4']['Baik']['entropy']) - (($result['epr4']['Sangat Baik']['count']/$total)*$result['epr4']['Sangat Baik']['entropy']);


    $result['gender']['gain'] = $gain_gender;
    $result['epr1']['gain'] = $gain_epr1;
    $result['epr2']['gain'] = $gain_epr2;
    $result['epr3']['gain'] = $gain_epr3;
    $result['epr4']['gain'] = $gain_epr4;

    return view('c45.result',['data'=>$result]);

  }

}
