<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\C45;
use Carbon\Carbon;
use DB;
use App\Imports\C45Import;
use Maatwebsite\Excel\Facades\Excel;

class C45Controller extends Controller
{
  public function index(Request $request)
  {
    $que = C45::get();

    $data = [];
    if(!$que->isEmpty()){
      foreach ($que as $value) {
        $data[] = array(
          'id' => $value->id,
          'no_peg' => $value->no_peg,
          'year' => $value->year,
          'name' => $value->name,
          'code' => $value->code,
          'code_text' => $value->code_text,
          'gender' => ($value->gender==0)?'Male':'Female',
          'persg' => ($value->persg==0)?'Pegawai Tetap':'PHK',
          'persk' => $value->persk,
          'ctr' => $value->ctr,
          'ctr_text' => $value->ctr_text,
          'birth_date' => Carbon::parse($value->birth_date)->format('d-m-Y'),
          'age' => $value->age,
          'join_date' => Carbon::parse($value->join_date)->format('d-m-Y'),
          'position' => $value->position,
          'position_text' => $value->position_text,
          'epr1' => $value->epr1,
          'epr2' => $value->epr2,
          'epr3' => $value->epr3,
          'epr4' => $value->epr4
        );
      }
    }

    return view('c45.index',['data'=>$data]);
  }

  public function add()
  {
    return view('c45.add');
  }

  public function save(Request $request)
  {
      $input = $request->all();
      $query = new C45;
      $query->no_peg = $input['no_peg'];
      $query->year = $input['year'];
      $query->name = $input['name'];
      $query->code = $input['code'];
      $query->code_text = $input['code_text'];
      $query->gender = $input['gender'];
      $query->persg = $input['persg'];
      $query->persk = $input['persk'];
      $query->ctr = $input['ctr'];
      $query->ctr_text = $input['ctr_text'];
      $query->birth_date = $input['birth_date'];
      $query->age = $input['age'];
      $query->join_date = $input['join_date'];
      $query->position = $input['position'];
      $query->position_text = $input['position_text'];
      $query->epr1 = $input['epr1'];
      $query->epr2 = $input['epr2'];
      $query->epr3 = $input['epr3'];
      $query->epr4 = $input['epr4'];
      $query->save();

      return redirect('c45');
  }

  public function edit($id)
  {
      $que = C45::find($id);
      return view('c45.edit',['data'=>$que]);

  }

  public function delete($id)
  {
      $que = C45::find($id)->delete();
      return redirect('c45');
  }

  public function update(Request $request)
  {
      $input = $request->all();
      $query = C45::find($input['id']);
      $query->no_peg = $input['no_peg'];
      $query->year = $input['year'];
      $query->name = $input['name'];
      $query->code = $input['code'];
      $query->code_text = $input['code_text'];
      $query->gender = $input['gender'];
      $query->persg = $input['persg'];
      $query->persk = $input['persk'];
      $query->ctr = $input['ctr'];
      $query->ctr_text = $input['ctr_text'];
      $query->birth_date = $input['birth_date'];
      $query->age = $input['age'];
      $query->join_date = $input['join_date'];
      $query->position = $input['position'];
      $query->position_text = $input['position_text'];
      $query->epr1 = $input['epr1'];
      $query->epr2 = $input['epr2'];
      $query->epr3 = $input['epr3'];
      $query->epr4 = $input['epr4'];
      $query->save();

      return redirect('c45');
  }

  public function import() 
  {
      Excel::import(new C45Import,request()->file('file'));
          
      return redirect('c45');
  }
}
