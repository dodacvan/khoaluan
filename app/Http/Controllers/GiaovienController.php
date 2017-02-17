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
class GiaovienController extends Controller {
	
	public function getinfo($id){
		$data = Giaovien::where('giaovien_id',$id)->orderBy('id','DESC')->get()->first();
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
		$data =  DB::table('yeucaus')->join('sinhviens','yeucaus.sinhvien_id','=','sinhviens.sinhvien_id')->select('yeucaus.*','sinhviens.*','yeucaus.id as yeucauid')->where('yeucaus.status','=',0)->get();
		return view('giaovien.yeucau',compact('data'));
	}

	public function postlistyeucau(Request $request){
		$yeucau = Yeucau::find($request->value);
		$sinhvien = Sinhvien::where('sinhvien_id',$yeucau->sinhvien_id)->get()->first();
		$giaovien = Giaovien::where('id',$yeucau->giaovien_id)->get()->first();
		if($request->action == 'access'){
			if($this->checksosinhvien($giaovien['hocvi'],$giaovien['sosinhvien'])){
				return response()->json([
				    'success' => 'false'
				]);
			}else{
				$yeucau->status = 1;
				$sinhvien->magiaovien = $yeucau->giaovien_id;
				$giaovien->sosinhvien = ++$giaovien->sosinhvien;
			}
		}else{
			$yeucau->status = 3;
		}
		$yeucau->save();
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

	public function getlistsinhvien($id){
		$giaovien = Giaovien::select('id')->where('giaovien_id',$id)->get()->first();
		//$data = Sinhvien::where('magiaovien',$giaovien->id)->get()->toArray();
		$data = DB::table('sinhviens')->join('yeucaus','sinhviens.sinhvien_id','=','yeucaus.sinhvien_id')->select('sinhviens.*','sinhviens.id as svid','yeucaus.tendetai')->where('sinhviens.magiaovien',$giaovien->id)->get();
		return view('giaovien.listsinhvien',compact('data'));
	}

	
}
