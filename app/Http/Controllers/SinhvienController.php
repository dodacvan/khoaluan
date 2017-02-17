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
class SinhvienController extends Controller {
	public function getinfo($id){
		$data = Sinhvien::where('sinhvien_id',$id)->orderBy('id','DESC')->get()->first();
		$giaovien = Giaovien::select('tengiaovien','id')->where('id',$data['magiaovien'])->get()->first();
		$detai = Yeucau::select('*')->where('sinhvien_id',$id)->get()->toArray();
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
}
