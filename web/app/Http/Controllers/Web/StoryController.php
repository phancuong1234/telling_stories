<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\StoryRepository\StoryRepositoryInterface;

class StoryController extends Controller
{
	protected $story;
	public function __construct(StoryRepositoryInterface $story)
	{
		$this->story = $story;
	}
	public function index()
	{
		$list= $this->story->getAll();
		return view('admin.story.index',compact('list'));
	}
	public function create()
	{
		return view('admin.story.create');
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
		$this->user->insert($data);
		return redirect('admin/user')->with(['success' => CREATE_SUCCESS]);
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
