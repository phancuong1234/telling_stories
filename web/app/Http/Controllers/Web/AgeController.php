<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Age;
use App\Repositories\AgeRepository\AgeRepositoryInterface;
use App\Services\AgeValidator;

class AgeController extends Controller
{
	protected $age;
	public function __construct(AgeRepositoryInterface $age)
	{
		$this->age = $age;
	}

	public function index()
	{
		$list = $this->age->getAll();
		return view('admin.age.index',compact('list'));
	}
	public function create() {
		return view('admin.age.create');
	}
	public function store(Request $request)
	{
		$validator = new AgeValidator($request->all());
		if ($validator->fails())
		{
			return redirect()->back()
			->withInput()
			->withErrors($validator->messages());
		}
		$this->age->create($request->age);
		return redirect('admin/age');
	}

	public function edit($id)
	{
		$check= $this->age->checkExists($id);
		if($check){
			$record= $this->age->getAgeById($id);
			return view('admin.age.edit',compact('record'));
		}else{
			abort(404);
		}
	}
	public function update(Request $request, $id)
	{
		$data =[
			'age' => $request->age
		];
		$validator = new AgeValidator($request->all());
		if ($validator->fails())
		{
			return redirect()->back()
			->withErrors($validator->messages());
		}
		$this->age->updateAgeById($id,$data);
		return redirect('admin/age');
	}

	public function destroy($id)
	{

		try {
			$this->age->deleteAgeWithID($id);
			return redirect('admin/age')->with(['success' => DELETE_SUCCESS]);
		} catch ( \Exception $e ){
			return redirect('admin/age');
		}
	}
}
