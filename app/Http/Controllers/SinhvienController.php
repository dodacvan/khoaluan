<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\SinhvienRequest;
use App\Http\Requests\DetaiResquest;
use App\Http\Controllers\Controller;
use App\Sinhvien;
use App\User;
use App\Giaovien;
use App\Detai;
use App\Yeucau;
use App\Huongnghiencuu;
use Illuminate\Http\Request;
use Hash;
use Auth;
use DB;
use Validator;
use Response;

class SinhvienController extends Controller {
	public function getcurrentsinhvien(){
		$sinhvien = Sinhvien::select('id')->where('sinhvien_id','=',Auth::user()->id)->get()->first();
		return $sinhvien['id'];
	}
	public function getinfo(){
		$data = Sinhvien::where('sinhvien_id','=',Auth::user()->id)->orderBy('id','DESC')->get()->first();
		$giaovien = Giaovien::select('tengiaovien','id')->where('id',$data['magiaovien'])->get()->first();
		$detai = Yeucau::select('*')->where('sinhvien_id',$data['sinhvien_id'])->get()->toArray();
		return view('sinhvien.info',compact('data','giaovien','detai'));
	}

	public function getlistgiaovien(){
		$data = Giaovien::select('id','tengiaovien','sdt','email','khoa','sosinhvien')->orderBy('id','DESC')->get()->toArray();
		return view('sinhvien.listgiaovien', compact('data'));
	}

	public function getadddetai($id){
		$data = Giaovien::select('id','tengiaovien')->where('id',$id)->get()->first();
		return view('sinhvien.adddetai',compact('data'));
	}

	public function checkdangki($value,&$message,&$status){
		$giaovien = Giaovien::where('id',$value->giaovien_id)->get()->first();
		switch ($giaovien['hocvi']) {
            case 0:
                $number = 0;
                break;
            case 1:
                $number = 0;
                break;
            case 2:
                $number = 5;
                break;
            default:
                $number = 7;
                break;
        }
        $check = true;
        if($number == $giaovien['sosinhvien']){
        	$check = false;
        	$message = "Giáo viên đã nhận đủ sinh viên";
        	$status = "danger";
        }
        if (Yeucau::where('sinhvien_id', '=', $value->sinhvien_id)->count() > 0) {
		   	$check = false;
        	$message = "Bạn đã đăng kí không thể đăng kí thêm";
        	$status = "danger";
		}
		return $check;
	}
	
	public function postadddetai(DetaiResquest $request){
			$message = "Yêu cầu được gửi tới giáo viên chờ phê duyệt";
        	$status = "success";
        	if($this->checkdangki($request,$message,$status)){
		   		$yeucau = new Yeucau();
				$yeucau->giaovien_id = $request->giaovien_id;
				$yeucau->sinhvien_id = $request->sinhvien_id;
				$yeucau->tendetai = $request->detai;
				$yeucau->status = 0;
				$yeucau->message = "Đề tài được gửi tới giáo viên chờ phê duyệt";
				$yeucau->save();
			}
		return redirect()->route('sinhvien.listgiaovien')->with(['flash_message'=>$message,'status'=>$status]);
	}

	public function getinfogiaovien($id){
		$data = Giaovien::where('id',$id)->orderBy('id','DESC')->get()->first();
		return view('sinhvien.infogiaovien',compact('data'));
	}

	public function getlisthnc(){
		$data = DB::table('huongnghiencuus')->join('giaoviens','huongnghiencuus.giaovien_id','=','giaoviens.id')->select('huongnghiencuus.*','giaoviens.id as giaovienid','giaoviens.tengiaovien')->get();
		return view('sinhvien.listhnc',compact('data'));
	}

	public function getlistdetai(){
		$data = DB::table('detais')->join('giaoviens','detais.giaovien_id','=','giaoviens.id')->select('detais.*','giaoviens.id as giaovienid','giaoviens.tengiaovien')->get();
		return view('sinhvien.listdetai',compact('data'));
	}

	// 0- tao de tai cho giao vien xac nhan
	// 1- duoc chap nhan
	// 2- duoc chap nhan - nhung  sua lai -cho giao vien chap nhan - chap nhan 1 ko chan nhan 3
	// 3- de tai gui len bi huy 
	// 4- de tai dc chap nhan nhung huy - cho giao vien chap nhan - chap nhan 3 ko chap nhan 1 
	public function posteditdetai(Request $request){
		$validation = Validator::make($request->all(), ['edittxtdetai' => 'required']);
			
		  if( $validation->fails())
		  {
		    $response = array(
	            'success' => 'false',
	            'status' => 1
	        );
		  }else{
		  	$yeucau = Yeucau::find($request->iddetai);
		  	if(!$yeucau){
				return response()->json([
					    'success' => 'false',
					    'status' => 2
				]);
			}
	        $yeucau->tendetai = $request->edittxtdetai;
	        if(in_array($yeucau->status, [1,2,4,5])){
	        	$yeucau->status = 2;
	        	$yeucau->message = "Thay đổi đề tài đã được chuyển đến giáo viên chờ phê duyệt";
	        }else{
		        $yeucau->status = 0;
		        $yeucau->message = "Đề tài được gửi tới giáo viên chờ phê duyệt";
	        }
	        $yeucau->save();
	        $response = array(
	            'success' => 'true'
	        );
	      }
	      return Response::json($response);
	}

	public function deletedetai(Request $request){
		$yeucau = Yeucau::find($request->id);
		if($yeucau){
			switch ($yeucau->status) {
				case 1:
					$yeucau->status = 4;
					$yeucau->message = "Yêu cầu hủy đăng kí đã được chuyển đến giáo viên chờ phê duyệt";
					$yeucau->save();
					break;
				case 2:
					$yeucau->status = 5;
					$yeucau->message = "Yêu cầu hủy đăng kí đã được chuyển đến giáo viên chờ phê duyệt";
					$yeucau->save();
					break;
				case 0:
				case 3:
					$yeucau->delete();
					break;
				case 4:
					$yeucau->status = 1;
					$yeucau->message = "Yêu cầu hủy đăng kí được hủy bỏ thành công";
					$yeucau->save();
					break;
				case 5:
					$yeucau->status = 2;
					$yeucau->message = "Đề tài được gửi lại tới giáo viên chờ phê duyệt";
					$yeucau->save();
					break;
				default:
					# code...
					break;
			}
			$response = array(
	            'success' => 'true'
	        );
		}else{
			$response = array(
	            'success' => 'false'
	    	);
	    }
	   return Response::json($response);
	}

 	public function getchangeinfo(){
		$sinhvien_id = $this->getcurrentsinhvien();
		$data = Sinhvien::select('id','email','diachi','sdt')->where('id',$sinhvien_id)->get()->first();
		return view('sinhvien.changeinfo',compact('data'));
	}

	public function postchangeinfo(Request $request){
		if($request->txtPass){
			$this->validate($request,['txtRePass'=>'required|same:txtPass'],['txtRePass.same'=>'re password not correct',
			'txtRePass.required'=>'please enter repass',]);
		}
		if($request->txtRePass){
			$this->validate($request,['txtPass'=>'required|same:txtRePass'],['txtRePass.same'=>' password not correct',
			'txtPass.required'=>'please enter pass',]);
		}
		$id = $this->getcurrentsinhvien();
		$this->validate($request,[
			'txtemail'=>'required|email|unique:giaoviens,email,'.$id,	
			'txtdiachi'=>'required',
			'txtsdt'=>'required|numeric'],[
			'txtemail.required'=>'Vui lòng điền email',
			'txtemail.email'=>'Email không đúng định dạng',
			'txtemail.unique'=>'Email đã tồn tại',
			'txtdiachi.required'=>'Vui lòng Điền địa chỉ',
			'txtsdt.required'=>'Vui lòng điền số điện thoại',
			'txtsdt.numeric'=>'Số điện thoại phải là số'
		]);
		$sinhvien = Sinhvien::find($id);
		$user = User::find($sinhvien->sinhvien_id);
		$sinhvien->email=$request->txtemail;
		if($request->txtPass){
			$user->password=Hash::make($request->txtPass);
		}
		$sinhvien->diachi=$request->txtdiachi;
		$sinhvien->sdt=$request->txtsdt;
		$sinhvien->save();
		$user->save();
		return redirect()->route('sinhvien.info')->with(['flash_message'=>'Sửa thông tin thành công','status'=>'success']);
	}
}
