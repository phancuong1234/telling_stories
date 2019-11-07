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
use App\Services\LoginValidator;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Repositories\ChartRepository\ChartRepositoryInterface;
use App\Charts\ReportChart;

class AdminController extends Controller
{
	protected $user;
	protected $chart;
	public function __construct(UserRepositoryInterface $user, ChartRepositoryInterface $chart)
	{
		$this->user = $user;
		$this->chart = $chart;
	}
	public function index()
	{

		return view('admin.dashboard');
	}

	public function getDataChart(Request $request, $id, $type)
	{

		$usersChart = new ReportChart;

		$report= $this->chart->getDataChart($id, $type);
		$count= [];
		if($type == 0){
			$count_date= [];
			foreach ($report as $key => $value) {
				$count_date[$value['date']]= $value['count'];
			}
			foreach ($count_date as $key => $value) {
				if($key == "Monday"){
					$count[0]= $value;
				} elseif($key == "Tuesday"){
					$count[1]= $value;
				}elseif($key == "Wednesday"){
					$count[2]= $value;
				}elseif($key == "Thursday"){
					$count[3]= $value;
				}elseif($key == "Friday"){
					$count[4]= $value;
				}elseif($key == "Saturday"){
					$count[5]= $value;
				}elseif($key == "Sunday"){
					$count[6]= $value;
				}
			}
			for ($i=0; $i < 7; $i++) {
				if(!isset($count[$i])){
					$count[$i]= 0;
				}
			}
			$usersChart->labels(['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN']);
		}
		if($type ==  1){
			foreach ($report as $key => $value) {
				$count[$value['month']]= $value['count'];
			}
			for ($i=1; $i < 13; $i++) {
				if(!isset($count[$i])){
					$count[$i]= 0;
				}
			}
			$usersChart->labels(['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC']);
		}
		if($type == 2){
			foreach ($report as $key => $value) {
				$count[$value['year']]= $value['count'];
			}
			for ($i=2010; $i < 2020; $i++) {
				if(!isset($count[$i])){
					$count[$i]= 0;
				}
			}
			$usersChart->labels(['2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019']);
		}
		ksort($count);
		
		if($id == 0){

			$usersChart->dataset('Users', 'line', array_values($count));
		}
		if($id == 1){
			$usersChart->dataset('Stories', 'line', array_values($count));
		}
		if($id == 2){
			$usersChart->dataset('Videos of user', 'line', array_values($count));
		}
		if($id == 3){
			$usersChart->dataset('Views', 'line', array_values($count));
		}

		
		return compact('usersChart');
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
		$validator = new LoginValidator($request->all());
		$data = [
			'email' => $request->email,
			'password' => $request->password,
		];
		$role= User::where('email','=',$request->email)->first();
		if ($validator->fails()) {
			return redirect()->back()
			->withErrors($validator->messages())
			->with([
				'email' => $request->email,
				'password' => $request->password
			]);
		}else{
			if(Auth::attempt($data)){
				if(($role->role_id == ADMIN || $role->role_id == MOD)){
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
				'remember_token' => session()->getId(),
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

	//get profile
	public function profile()
	{
		$id= Auth::id();
		$record= $this->user->getUserById($id);

		return view('admin.profile',compact('record'));
	}
	public function showEditProfile()
	{
		$id= Auth::id();
		$record= $this->user->getUserById($id);

		return view('admin.editProfile',compact('record'));
	}
	//update profile
	public function editProfile(Request $request)
	{
		$id= Auth::id();
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
		return redirect('admin/profile')->with(['success' => UPDATE_SUCCESS]);;
	}
}
