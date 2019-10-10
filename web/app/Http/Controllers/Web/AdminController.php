<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use DB;
use App\User;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
	public function index()
	{
		return view('admin.dashboard');
	}

	public function showLogin()
	{
		if(Auth::check()){
			return redirect()->back();
		}else{
			session()->flash('urlPre', URL::previous());

			return view('auth.login');
		}
	}

	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required',
			'password' => 'required',
		]);
		$data = [
			'email' => $request->email,
			'password' => $request->password,
		];
		$role= User::where('email','=',$request->email)->first();
		if ($validator->fails()) {
			return redirect()->back()
			->withErrors($validator)
			->with([
				'email' => $request->email,
				'password' => $request->password
			]);
		}else{
			if($role->role_id == ADMIN || $role->role_id == MOD){
				if(Auth::attempt($data)){
					$id= Auth::id();
					$this->updateToken($id);
					return redirect()->route('admin.index');
				}

			}
			return redirect()->back()->with([
				'login_fail' => LOGIN_FAIL,
				'email' => $request->email,
				'password' => $request->password
			]);
		}
	}

	public function updateToken($id) {
		DB::beginTransaction();
		try {
			User::where(
				[
					['id', '=', $id]
				])
			->update([
				'token' => session()->getId(),
				'updated_at' => Carbon::now(),
			]);
			$admin = User::where(
				[
					['id', '=', $id]
				])->first();
			DB::commit();
			return $admin;
		} catch (Exception $e) {
			DB::rollBack();
			return 0;
		}
	}

	public function logout(Request $request)
	{
		Auth::logout();
		return redirect()->route('show_login');
	}
}
