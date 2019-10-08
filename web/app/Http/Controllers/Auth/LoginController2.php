<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class LoginController2 extends Controller
{
 public function index()
 {
  return view('auth.login');
}
public function login(Request $request)
{
  
  $data = [
    'email' => $request->email,
    'password' => $request->password,
  ];
  if(Auth::attempt($data)){
   return redirect()->route('admin.index');
 }else{
   return back();
 }
}
}
