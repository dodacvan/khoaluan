<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Thoigian;

class ThoigianController extends Controller {

	public function getSetTime(){
		$thoigian = Thoigian::get()->first();
		return view('giaovu.settime',compact('thoigian'));
	}

	public function postSetTime(Request $request){
		$thoigian = Thoigian::find(1);
		if($request->timestart == ""){
			$newtimestart = $thoigian->thoigianbatdau;
		}else{
			$newtimestart = $request->timestart;
		}

		if($request->timeend == ""){
			$newtimeend = $thoigian->thoigianketthuc;
		}else{
			$newtimeend = $request->timeend;
		}
		if($newtimestart > $newtimeend){
			return json_encode(array('success'=>'false'));
		}
		$thoigian->thoigianbatdau = $newtimestart;
		$thoigian->thoigianketthuc = $newtimeend;
		$thoigian->save();
		return json_encode(array('success'=>'true'));
	}

}
