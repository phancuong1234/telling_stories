<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Services\UserValidator;
use App\Services\UserValidatorEdit;

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
	//change state user
	public function changeState(Request $request, $id)
	{
		return $this->user->changeState($id, $request->state);
	}
	public function create()
	{
		return view('admin.user.create');
	}
	public function validateData(Request $request)
	{
		$validator = new UserValidator($request->all());
		$check= $this->user->checkExistEmail($request->email);
		if ($validator->fails())
		{
			return response()->json('errorVal');
		}else if($check){
			return response()->json('existEmail');
		}else{
			return response()->json('success');
		}
	}
	public function store(Request $request)
	{

		$data= [
			'name' => $request->name,
			'email' => $request->email,
			'password' => $request->password,
			'address' => $request->address,
			'gender' =>$request->gender,
			'birthday' => $request->birthday,
			'role_id' => $request->role,
			'avatar' => $request->avatar,
		];
		
		$this->user->insert($data);
		return redirect('admin/user')->with(['success' => CREATE_SUCCESS]);
	}
	public function detail($id)
	{
		$record= $this->user->getUserById($id);
		return view('admin.user.detail',compact('record'));
	}
	public function edit(Request $request, $id)
	{
		$record= $this->user->getUserById($id);
		return view('admin.user.edit')->with('record',$record);
	}
	public function validateDataEdit(Request $request)
	{
		$validator = new UserValidatorEdit($request->all());
		if ($validator->fails())
		{
			return response()->json('errorVal');
		}else if($check){
			return response()->json('existEmail');
		}else{
			return response()->json('success');
		}
	}
	public function update(Request $request, $id)
	{
		$data= [
			'name' => $request->name,
			'email' => $request->email,
			'address' => $request->address,
			'gender' =>$request->gender,
			'birthday' => $request->birthday,
			'avatar' => $request->avatar,
			'role_id' => $request->role
		];
		$this->user->updateUserById($id,$data);
		return redirect('admin/user')->with(['success' => UPDATE_SUCCESS]);
	}
	public function destroy($id)
	{
		try {
			$this->user->deleteUserWithID($id);
			return redirect('admin/user')->with(['success' => DELETE_SUCCESS]);
		} catch ( \Exception $e ){
			return redirect('admin/user')->with(['error' => DELETE_FAIL]);
		}
	}
}
