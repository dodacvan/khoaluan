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
			$yeucau->status = 1;
			$sinhvien->magiaovien = $yeucau->giaovien_id;
			$giaovien->sosinhvien = ++$giaovien->sosinhvien;
		}else{
			$yeucau->status = 3;
		}
		$yeucau->save();
		$sinhvien->save();
		return response()->json([
		    'success' => 'true'
		]);
	}

	public function getinfosinhvien($id){
		$data = Sinhvien::where('id',$id)->orderBy('id','DESC')->get()->first();
		return view('giaovien.infosinhvien',compact('data'));
	}

	public function getlistsinhvien($id){
		$giaovien = Giaovien::select('id')->where('giaovien_id',$id)->get()->first();
		$data = Sinhvien::where('magiaovien',$giaovien->id)->get()->toArray();
		return view('giaovien.listsinhvien',compact('data'));
	}

	
}
