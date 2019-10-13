<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository\UserRepositoryInterface;

class UserController extends Controller
{
	protected $user;
	public function __construct(UserRepositoryInterface $user)
	{
		$this->user = $user;
	}
	public function index()
	{
		$list= $this->user->getAll();
		return view('admin.user.index',compact('list'));
	}
	public function create()
	{
		return view('admin.user.create');
	}
	public function store(Request $request)
	{


		dd($request->all());
		$data= [
			'name' => $request->name,
			'email' => $request->email,
			'password' => $request->password,
			'address' => $request->address,
			'gender' =>$request->gender,
			'birthday' => $request->birthday,
			'avatar' => $request->avatar,
			'role_id' => $request->role
		];
		// $validator = new CategoryValidator($request->all());
		// if ($validator->fails())
		// {
		// 	return redirect()->back()
		// 	->withInput()
		// 	->withErrors($validator->messages());
		// }
		// $list = $this->category->getAll();
		//$this->user->insert($data);
		return redirect('admin/user');
	}
	public function update_avatar(Request $request)
	{
		dd('hh');
	}
}
