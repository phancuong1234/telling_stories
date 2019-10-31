<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Services\UserValidator;

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
	public function upAvatar(Request $request)
	{
		
	}
	public function store(Request $request)
	{

		$validator = new UserValidator($request->all());
		if ($validator->fails())
		{
			return response()->json(['errors' => 'lỗi']);
		}
		$check= $this->user->checkExistEmail($request->email);
		$data= [
			'name' => $request->name,
			'email' => $request->email,
			'password' => $request->password,
			'address' => $request->address,
			'gender' =>$request->gender,
			'birthday' => $request->birthday,
			'role_id' => $request->role
		];
		
		if($check){
			$this->user->insert($data);
			return response()->json(['success' => CREATE_SUCCESS]);
			//return redirect('admin/user')->with(['success' => CREATE_SUCCESS]);
		}else{
			return response()->json(['error' => ERROR_CREATE_USER]);
			//return redirect('admin/user')->with(['error' => ERROR_CREATE_USER]);
		}
		
		
	}
	public function detail($id)
	{
		$record= $this->user->getUserById($id);
		return view('admin.user.detail',compact('record'));
	}
	public function edit($id)
	{
		$record= $this->user->getUserById($id);
		return view('admin.user.edit',compact('record'));
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
		return redirect('admin/user')->with(['success' => UPDATE_SUCCESS]);;
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
