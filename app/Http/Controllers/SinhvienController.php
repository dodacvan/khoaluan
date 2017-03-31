<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\SinhvienRequest;
use App\Http\Requests\DetaiResquest;
use App\Http\Requests\EditLichhen;
use App\Http\Requests\Lichhen as RequestLichhen;
use App\Http\Controllers\Controller;
use App\Sinhvien;
use App\User;
use App\Giaovien;
use App\Detai;
use App\Yeucau;
use App\Lichhen;
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
		if(empty($detai)){
			$yeucaugiaovien = '';
		}else{
			$yeucaugiaovien = Giaovien::find($detai[0]['giaovien_id']);
			
		}
		return view('sinhvien.info',compact('data','giaovien','detai','yeucaugiaovien'));
	}

	public function getlistgiaovien(){
		$data = Giaovien::select('id','tengiaovien','sdt','email','bomon','sosinhvien','hocvi', 'sosinhvienCA')->orderBy('id','DESC')->get()->toArray();
		$messageShow = "";
		if($this->checkYc()){
			$messageShow = "Bạn đã tạo một đăng kí, xóa đăng kí cũ để tạo đăng kí mới";
		}
		$newdata = array();
		foreach ($data as $items) {
			$items['show'] = $this->checkshow($items);
			$newdata[] = $items;
		}
		return view('sinhvien.listgiaovien', compact('newdata','messageShow'));
	}

	public function getadddetai($id){
		$data = Giaovien::select('id','tengiaovien')->where('id',$id)->get()->first();
		return view('sinhvien.adddetai',compact('data'));
	}
	public function checkshow($giaovien){
		$numberCA =0;
		switch ($giaovien['hocvi']) {
            case "":
                $number = 0;
                break;
            case "CN":
                $number = 0;
                break;
            case "Ths":
                $number = 3;
                break;
            default:
            	$numberCA =3;
                $number = 5;
                break;
        }
        $check = true;
        if($this->checkSvCA()){
	        if($numberCA <= $giaovien['sosinhvienCA'] && $numberCA){
	        	$check = false;
	        }
        }
        if($number <= $giaovien['sosinhvien']){
        	$check = false;
        }
        return $check;
	}

	public function checkdangki($value,&$message,&$status){
		$giaovien = Giaovien::where('id',$value->giaovien_id)->get()->first();
		$numberCA =0;
		switch ($giaovien['hocvi']) {
            case "":
                $number = 0;
                break;
            case "CN":
                $number = 0;
                break;
            case "Ths":
                $number = 3;
                break;
            default:
            	$numberCA =3;
                $number = 5;
                break;
        }
        $check = true;
        if($this->checkSvCA()){
	        if($numberCA <= $giaovien['sosinhvienCA']){
	        	$check = false;
	        	$message = "Giao viên đã nhận đủ sinh viên lớp nhiệm vụ chiến lược";
	        	$status = "danger";
	        }
        }
        if($number <= $giaovien['sosinhvien']){
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
	
	public function checkSvCA(){
		$sinhvien = Sinhvien::find($this->getcurrentsinhvien());
		if($sinhvien->nganh == "Khoa học máy tính"){
			return true;
		}
		return false;
	}

	public function checkYc(){
		$sinhvien = Sinhvien::find($this->getcurrentsinhvien());
		if(Yeucau::where('sinhvien_id', '=', $sinhvien->sinhvien_id)->count() > 0){
			return true;
		}
		return false;

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
		$hnc = Huongnghiencuu::where('giaovien_id',$data['id'])->get()->toArray();
		$detai = Detai::select('id','ten')->where('giaovien_id',$data['id'])->get()->toArray();
		return view('sinhvien.infogiaovien',compact('data','hnc','detai'));
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
	// 1- duoc chap nhan neu thay doi thi la 2 va neu xoa thi la 4
	// 2- duoc chap nhan - nhung  sua lai -cho giao vien chap nhan - chap nhan 1 ko chan nhan 6 - edit thi 2 xoa thi 5
	// 3- de tai gui len bi huy -edit thi len 0
	// 4- de tai dc chap nhan nhung huy - cho giao vien chap nhan - chap nhan xoa ko chap nhan 1 -edit thanh 2 xoa thi 1
	// 5- da ng o 2 thi huy nen thanh 5, giao vien chap nhan thi xoa ko chap nhan thi 2, sv edit thi 2 con delete thi la 2
	// 6- sua de tai va ko dc giao vien chap nhan -edit thi la 2 con delete thi la 7
	// 7- xoa de tai ,giao vien chap nhan xoa, ko chap nhan thi la 6 , sinh vien edit thi la 2 huy thi la 6
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
	        if(in_array($yeucau->status, [1,2,4,5,6,7])){
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
					$yeucau->message = "Bạn đã yêu cầu hủy đăng kí, giáo viên đang phê duyệt";
					$yeucau->save();
					break;
				case 2:
					$yeucau->status = 5;
					$yeucau->message = "Bạn đã yêu cầu hủy đăng kí, giáo viên đang phê duyệt";
					$yeucau->save();
					break;
				case 0:
				case 3:
					$yeucau->delete();
					break;
				case 4:
					$yeucau->status = 1;
					$yeucau->message = "Yêu cầu hủy đăng kí được hủy bỏ thành công, bạn phải tiếp tục thực hiện đề tài";
					$yeucau->save();
					break;
				case 5:
					$yeucau->status = 2;
					$yeucau->message = "Đề tài được gửi lại tới giáo viên chờ phê duyệt";
					$yeucau->save();
					break;
				case 6:
					$yeucau->status = 7;
					$yeucau->message = "Bạn đã yêu cầu hủy đăng kí, giáo viên đang phê duyệt";
					$yeucau->save();
					break;
				case 7:
					$yeucau->status = 6;
					$yeucau->message = "Yêu cầu hủy đăng kí được hủy bỏ thành công, bạn cần đề xuất đề tài mới tới giáo viên";
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
	public function getlistlichhen(){
		$id = Auth::user()->id;
		$data = DB::table('giaoviens')->join('lichhens','giaoviens.id','=','lichhens.giaovien_id')->select('giaoviens.tengiaovien','giaoviens.id as gvid','lichhens.id as id','lichhens.*')->where('lichhens.sinhvien_id',$id)->get();
		return view('sinhvien.listlichhen',compact('data'));
	}

	public function addlichhen($id){
		$data = Giaovien::select('id','tengiaovien')->where('id',$id)->get()->first();
		return view('sinhvien.addlichhen',compact('data'));
	}

	public function postaddlichhen(RequestLichhen $request){
		$lichhen = new Lichhen();
		$lichhen->sinhvien_id = $request->sinhvien_id;
		$lichhen->giaovien_id = $request->giaovien_id;
		$lichhen->tieude = $request->title;
		$lichhen->thoigian = $request->time;
		$lichhen->diadiem = $request->place;
		$lichhen->type = $request->type;
		$lichhen->status = 1;
		$lichhen->save();
		return redirect()->route('sinhvien.listlichhen')->with(['flash_message'=>'Thêm lịch hẹn thành công','status'=>'success']);
	}

	public function geteditlichhen($id){
		$data = Lichhen::find($id);
		if(!empty($data)){
			$giaovien = Giaovien::where('id',$data['giaovien_id'])->get()->first();
		}
		return view('sinhvien.editlichhen',compact('data','giaovien'));
	}

	public function posteditlichhen(EditLichhen $request)
	{
		$lichhen = Lichhen::find($request->id);
		$lichhen->diadiem = $request->place;
		$lichhen->tieude = $request->title;
		$lichhen->type = 1;
		if($request->has('time')){

			$lichhen->thoigian = $request->time;
		}
		$lichhen->save();
		return redirect()->route('sinhvien.listlichhen')->with(['flash_message'=>'Sửa lịch hẹn thành công','status'=>'success']);
	}

	public function deletelichhen($id){
		Lichhen::destroy($id);
		return redirect()->route('sinhvien.listlichhen')->with(['flash_message'=>'Xóa lịch hẹn thành công','status'=>'success']);
	}
}
