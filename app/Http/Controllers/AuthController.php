<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;

use Auth;
use Hash;
use App\User;

class AuthController extends Controller
{
  public function index()
  {
    return view('pages.login');
  }

  public function login(Request $request)
  {
    $username = $request->username;
    $password = $request->password;

    if(Auth::attempt(['username' => $username, 'password' => $password]) ) {
      return redirect('/')->with('success', 'You have been logged in to Itzeee');
    } else {
      return view('pages.login',['error'=>'Invalid Username or Password']);
    }
    return redirect('/')->with('success', 'You have been logged in to Itzeee');
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/login');
  }

}
