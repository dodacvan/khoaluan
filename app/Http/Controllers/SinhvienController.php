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
	
	public function postadddetai(DetaiResquest $request){
		$yeucau = new Yeucau();
		$yeucau->giaovien_id = $request->giaovien_id;
		$yeucau->sinhvien_id = $request->sinhvien_id;
		$yeucau->tendetai = $request->detai;
		$yeucau->status = 0;
		$yeucau->save();
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
