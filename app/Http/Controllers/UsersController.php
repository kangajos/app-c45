<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;

class UsersController extends Controller
{
  public function index(Request $request)
  {
    $que = User::get();

    $data = [];
    if(!$que->isEmpty()){
      foreach ($que as $value) {
        $data[] = array(
          'id' => $value->id,
          'name' => $value->name,
          'username' => $value->username,
        );
      }
    }

    return view('users.index',['data'=>$data]);
  }

  public function add()
  {
    return view('users.add');
  }

  public function save(Request $request)
  {
      $input = $request->all();
      $query = new User;
      $query->name = $input['name'];
      $query->username = $input['username'];
      $query->password = Hash::make($input['password']);
      $query->save();

      return redirect('users');
  }

  public function edit($id)
  {
      $que = User::find($id);
      return view('users.edit',['data'=>$que]);

  }

  public function delete($id)
  {
      $que = User::find($id)->delete();
      return redirect('users');
  }

  public function update(Request $request)
  {
      $input = $request->all();
      $query = User::find($input['id']);
      $query->name = $input['name'];
      $query->username = $input['username'];
      if(!empty($input['password'])) $query->password = Hash::make($input['password']);
      $query->save();

      return redirect('users');
  }
}
