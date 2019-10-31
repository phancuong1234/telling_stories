<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Services\CategoryValidator;

class CategoryController extends Controller
{
	protected $category;
	public function __construct(CategoryRepositoryInterface $category)
	{
		$this->category = $category;
	}

	public function index()
	{
		$list = $this->category->getAll();
		return view('admin.category.index',compact('list'));
	}
	public function showAdd() {
		return view('admin.category.add');
	}
	public function add(Request $request)
	{
		$validator = new CategoryValidator($request->all());
		if ($validator->fails())
		{
			return redirect()->back()
			->withInput()
			->withErrors($validator->messages());
		}
		$list = $this->category->getAll();
		$this->category->create($request->category);
		return redirect('admin/category');
	}

	public function showEdit($id)
	{
		$checkId= $this->category->checkExists($id);
		if($checkId){
			$categoryEdit= $this->category->getCategoryById($id);
			return view('admin.category.edit',compact('categoryEdit'));
		}else{
			abort(404);
		}
		
	}
	public function edit(Request $request, $id)
	{
		$data =[
			'name' => $request->category
		];
		$validator = new CategoryValidator($request->all());
		if ($validator->fails())
		{
			return redirect()->back()
			->withErrors($validator->messages());
		}
		$this->category->updateCategoryById($id,$data);
		return redirect('admin/category');
	}

	public function delete($id)
	{

		try {
			$this->category->deleteCategoryWithID($id);
			return redirect('admin/category')->with(['success' => DELETE_SUCCESS]);
		} catch ( \Exception $e ){
			return redirect('admin/category');
		}
	}
}
