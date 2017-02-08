<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
	public function getLogin(){
		return view('giaovu.login');
	}

	public function postLogin(LoginRequest $request){
		$login=array(
			'name'=>$request->username,
			'password'=>$request->password
		);
		if(Auth::attempt($login)){
			switch (Auth::user()->type) {
				case 1:
					return redirect()->route('giaovien.info',Auth::user()->id);
					break;
				case 2:
					return redirect()->route('sinhvien.listgiaovien');
					break;
				case 3:
					return redirect()->route('giaovu.listgiaovien');
					break;
				default:
					
					break;
			}
			return redirect()->route('giaovu.listgiaovien');
		}else{
			return redirect()->back()->with(['flash_message'=>'username or password incorrect']);
		}
	}
	public function getLogout(){
		$this->auth->logout();
		return redirect()->route('login.new');
	}
}
