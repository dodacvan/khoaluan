<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GiaovienRequest;
use App\Detai;
use App\Giaovien;
use App\Sinhvien;
use App\Yeucau;
use App\Huongnghiencuu;
use App\User;
use Response;
use Validator;
use DB;
use Redirect;
use Illuminate\Support\Facades\Auth;
class GiaovienController extends Controller {
	
	public function getcurrentgiaovien(){
		$giaovien = Giaovien::select('id')->where('giaovien_id','=',Auth::user()->id)->get()->first();
		return $giaovien['id'];
	}

	public function getinfo(){
		$data = Giaovien::where('giaovien_id','=',Auth::user()->id)->get()->first();
		$hnc = Huongnghiencuu::where('giaovien_id',$data['id'])->get()->toArray();
		$sinhvien = Sinhvien::select('id','ten')->where('magiaovien',$data['id'])->get()->toArray();
		$detai = Detai::select('id','ten')->where('giaovien_id',$data['id'])->get()->toArray();
		return view('giaovien.info',compact('data','hnc','sinhvien','detai'));
	}
	
	public function postaddhnc(Request $request){
		$validation = Validator::make($request->all(), ['txthnc' => 'required']);
			
		  if( $validation->fails())
		  {
		    // return json_encode([
		    //         'errors' => $validation->errors()->getMessages(),
		    //         'success' => 'false'
		    //      ], 400);
		    $response = array(
	            'success' => 'false'
	        );
		  }else{
			$response = array(
	            'success' => 'true'
	        );
	        $hnc = new Huongnghiencuu();
	        $hnc->ten = $request->txthnc;
	        $hnc->giaovien_id = $request->giaovien_id;
	        $hnc->save();
	      }
	        return Response::json($response); 
	}

	public function edithnc(Request $request){
		$validation = Validator::make($request->all(), ['edittxthnc' => 'required']);
			
		  if( $validation->fails())
		  {
		    // return json_encode([
		    //         'errors' => $validation->errors()->getMessages(),
		    //         'success' => 'false'
		    //      ], 400);
		    $response = array(
	            'success' => 'false'
	        );
		  }else{
			$response = array(
	            'success' => 'true'
	        );
	        $hnc = Huongnghiencuu::where('id',$request->idhnc)->get()->first();
	        $hnc->ten = $request->edittxthnc;
	        $hnc->save();
	      }
	      return Response::json($response);
	}

	public function deletehnc(Request $request){
		$hnc = Huongnghiencuu::where('id',$request->id)->get()->first();
		if($hnc){
			$hnc->delete();
			$response = array(
	            'success' => 'true'
	        );
		}else
		$response = array(
	            'success' => 'false'
	    );
	    return Response::json($response);
	}

	public function postadddetai(Request $request){
		$validation = Validator::make($request->all(), ['txtdetai' => 'required']);
			
		  if( $validation->fails())
		  {
		    $response = array(
	            'success' => 'false'
	        );
		  }else{
			$response = array(
	            'success' => 'true'
	        );
	        $detai = new Detai();
	        $detai->ten = $request->txtdetai;
	        $detai->giaovien_id = $request->giaovien_id;
	        $detai->sinhvien_id=0;
	        $detai->type = 0;
	        $detai->save();
	      }
	        return Response::json($response); 
	}

	public function editdetai(Request $request){
		$validation = Validator::make($request->all(), ['edittxtdetai' => 'required']);
			
		  if( $validation->fails())
		  {
		    $response = array(
	            'success' => 'false'
	        );
		  }else{
			$response = array(
	            'success' => 'true'
	        );
	        $hnc = Detai::where('id',$request->iddetai)->get()->first();
	        $hnc->ten = $request->edittxtdetai;
	        $hnc->save();
	      }
	      return Response::json($response);
	}

	public function deletedetai(Request $request){
		$detai = Detai::where('id',$request->id)->get()->first();
		if($detai){
			$detai->delete();
			$response = array(
	            'success' => 'true'
	        );
		}else
		$response = array(
	            'success' => 'false'
	    );
	    return Response::json($response);
	}

	

	public function getlistyeucau(){
		// $data = DB::table('detais')->join('giaoviens', function ($join){
		// 	            $join->on('giaoviens.id', '=', 'detais.giaovien_id')
		// 	                 ->where('detais.type','=',0);})
		// 			->join('sinhviens', function ($join){
		// 	            $join->on('detais.sinhvien_id', '=', 'sinhviens.sinhvien_id');})
		// 			->select('detais.*','sinhviens.*','sinhviens.id as idsinhvien','detais.ten as tendt')->get();
		$giaovien_id = $this->getcurrentgiaovien();
		$data =  DB::table('yeucaus')->join('sinhviens','yeucaus.sinhvien_id','=','sinhviens.sinhvien_id')->select('yeucaus.*','sinhviens.*','yeucaus.id as yeucauid')->whereIn('yeucaus.status', [0, 2, 4, 5, 7])->where('yeucaus.giaovien_id','=',$giaovien_id)->get(); 
		return view('giaovien.yeucau',compact('data'));
	}

	public function postlistyeucau(Request $request){
		$yeucau = Yeucau::find($request->value);
		if(!$yeucau){
			return response()->json([
				    'success' => 'false',
				    'message' => 'Không tìm thấy sinh viên'
			]);
		}
		$sinhvien = Sinhvien::where('sinhvien_id',$yeucau->sinhvien_id)->get()->first();
		$giaovien = Giaovien::where('id',$yeucau->giaovien_id)->get()->first();
		if($request->action == 'access'){
			$check = $this->checksosinhvien($giaovien['hocvi'],$giaovien['sosinhvien']);
			if($check){

				switch ($yeucau->status) {
					case 0:
						return response()->json([
						    'success' => 'false',
						    'message' => 'Đã nhận đủ sinh viên không thể nhận thêm'
						]);
						break;
					case 2:
						$yeucau->status = 1;
						$yeucau->message = "Đề tài đã được giáo viên chấp nhận";
						$yeucau->save();
						break;
					default:
						$yeucau->delete();
						$sinhvien->magiaovien = 0;
						$giaovien->sosinhvien = ($giaovien->sosinhvien) - 1;
						break;
				}
			}else{
				switch ($yeucau->status) {
					case 0:
						$yeucau->status = 1;
						$yeucau->message = "Đề tài đã được giáo viên chấp nhận";
						$sinhvien->magiaovien = $yeucau->giaovien_id;
						$giaovien->sosinhvien = ++$giaovien->sosinhvien;
						$yeucau->save();
						break;
					case 2:
						$yeucau->status = 1;
						$yeucau->message = "Đề tài đã được giáo viên chấp nhận";
						$yeucau->save();
						break;
					default:
						$yeucau->delete();
						$sinhvien->magiaovien = 0;
						$giaovien->sosinhvien = ($giaovien->sosinhvien) - 1;
						break;
				}
			}
		}else{
			switch ($yeucau->status) {
				case 0:
					$yeucau->status = 3;
					$yeucau->message = "Đề tài không được giáo viên chấp nhận";
					$yeucau->save();
					break;
				case 2:
					$yeucau->status = 6;
					$yeucau->message = "Thay đổi đề tài không được chấp nhận yêu cầu chỉnh sửa lại";
					$yeucau->save();
					break;
				case 4:
					$yeucau->status = 1;
					$yeucau->message = "Yêu cầu hủy đăng kí không được chấp nhận";
					$yeucau->save();
					break;
				case 5:
					$yeucau->status = 2;
					$yeucau->message = "Yêu cầu hủy đăng kí không được chấp nhận";
					$yeucau->save();
					break;
				default:
					$yeucau->status = 6;
					$yeucau->message = "Yêu cầu hủy đăng kí không được chấp nhận thay đổi lại đề tài mới để giáo viên phê duyệt";
					$yeucau->save();
					break;
			}
		}
		
		$sinhvien->save();
		$giaovien->save();
		return response()->json([
		    'success' => 'true'
		]);
	}

	public function checksosinhvien($value,$sosinhvien){
		switch ($value) {
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
        if($sosinhvien >= $number){
        	return true;
        }
        return false;
	}

	public function getinfosinhvien($id){
		$data = Sinhvien::where('id',$id)->orderBy('id','DESC')->get()->first();
		$giaovien = Giaovien::where('id',$data['magiaovien'])->get()->first();
		return view('giaovien.infosinhvien',compact('data','giaovien'));
	}

	public function getlistsinhvien(){
		$giaovien = $this->getcurrentgiaovien();
		//$data = Sinhvien::where('magiaovien',$giaovien->id)->get()->toArray();
		$data = DB::table('sinhviens')->join('yeucaus','sinhviens.sinhvien_id','=','yeucaus.sinhvien_id')->select('sinhviens.*','sinhviens.id as svid','yeucaus.tendetai','yeucaus.status')->where('sinhviens.magiaovien',$giaovien)->get();
		return view('giaovien.listsinhvien',compact('data'));
	}
	public function getchangeinfo(){
		$giaovien_id = $this->getcurrentgiaovien();
		$data = Giaovien::select('id','email','quequan','diachi','sdt')->where('id',$giaovien_id)->get()->first();
		return view('giaovien.changeinfo',compact('data'));
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
		$id = $this->getcurrentgiaovien();
		$this->validate($request,[
			'txtemail'=>'required|email|unique:giaoviens,email,'.$id,	
			'txtdiachi'=>'required',
			'txtquequan'=>'required',
			'txtsdt'=>'required|numeric'],[
			'txtemail.required'=>'Vui lòng điền email',
			'txtemail.email'=>'Email không đúng định dạng',
			'txtemail.unique'=>'Email đã tồn tại',
			'txtdiachi.required'=>'Vui lòng Điền địa chỉ',
			'txtquequan.required'=>'Vui lòng điền quê quán',
			'txtsdt.required'=>'Vui lòng điền số điện thoại',
			'txtsdt.numeric'=>'Số điện thoại phải là số'
		]);
		$giaovien = Giaovien::find($id);
		$user = User::find($giaovien->giaovien_id);
		$giaovien->email=$request->txtemail;
		if($request->txtPass){
			$user->password=Hash::make($request->txtPass);
		}
		$giaovien->diachi=$request->txtdiachi;
		$giaovien->quequan=$request->txtquequan;
		$giaovien->sdt=$request->txtsdt;
		$giaovien->save();
		$user->save();
		return redirect()->route('giaovien.info')->with(['flash_message'=>'Sửa thông tin thành công']);
	}
}
