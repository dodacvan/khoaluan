<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Detai;
use App\Giaovien;
use App\Sinhvien;
use App\User;
use Input;
use DB;
use Excel;
use Hash;
use Exception;
class DetaiController extends Controller {
	public function importExport()
	{
		return view('importExport');
	}
	public function downloadExcel($type)
	{
		$data = Detai::get()->toArray();
		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
	public function importExcel()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					try{
						if(!$this->checkemail($value->email)){
							$user = new User();
							$ten = $this->exname($value->name);
							$check = User::select('id')->where('type', 1)->where('name','like',$ten.'%')->get()->toArray();
							$count = count($check);
							 if($count==0){
							 	$user->name = $ten;
							 }else{
							 	$user->name = $ten.$count;
							 }
							$user->email = $value->email;
							$user->password =  Hash::make('123');
							$user->type = 1;
							$user->save();

							$data = User::select('name','email','type','id')->where('email',$value->email)->get()->first();
							$giaovien = new Giaovien();
							$giaovien->tengiaovien = $value->name;
							$giaovien->email = $data['email'];
							$giaovien->magiaovien = $data['id'];
							$giaovien->ngaysinh = $value->ngaysinh;
							$giaovien->quequan = $value->quequan;
							$giaovien->gioitinh = $value->gioitinh;
							$giaovien->diachi = $value->diachi;
							$giaovien->chucdanh = $value->chucdanh;
							$giaovien->hocham = $value->hocham;
							$giaovien->hocvi =$value->hocvi;
							$giaovien->khoa = "CNTT";
							$giaovien->bomon = $value->bomon;
							$giaovien->sdt = $value->sdt;
							$giaovien->sosinhvien = 0;
							$giaovien->sosinhvienCA = 0;
							$giaovien->giaovien_id = $data['id'];
							$giaovien->save();
						}	
					}catch (\Exception $e) {
					    return $e->getMessage();
					}
					
				}
			}
		}
		return redirect()->route('giaovu.listgiaovien')->with(['flash_message'=>'Thêm thành công giáo viên']);
	}

	public function checkemail($email){

		if (User::where('email', '=', $email)->count() > 0) {
		   return true;
		}
		return false;
	}

	public function SVimport()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					try{
						if(!$this->checkemail($value->email)){
							 $user = new User();
							 $khoa = substr($value->lop, 0, 2);
							 $ten = $this->exname($value->name);
							 $check = DB::table('users')->join('sinhviens', function ($join) use($khoa, $ten) {
								            $join->on('users.id', '=', 'sinhviens.sinhvien_id')
								                 ->where('sinhviens.lop', 'like', $khoa.'%')->where('users.name', 'like', $ten.'%');
								        })->select('users.id')->get();
							 $number = count($check);
							 if($number==0){
							 	$user->name = $ten."_".$khoa;
							 }else{
							 	$user->name = $ten.$number."_".$khoa;
							 }
							$user->email = $value->email;
							//$user->password =  Hash::make($this->expass());
							$user->password =  Hash::make('123');
							$user->type = 2;
							$user->save();
									
							$data = User::select('id','name','email','type')->where('email',$value->email)->get()->first();
							$sinhvien = new Sinhvien();
							$sinhvien->masinhvien = $value->masinhvien;
							$sinhvien->ten = $value->name;
							$sinhvien->sdt = $value->sdt;
							$sinhvien->diachi = $value->diachi;
							$sinhvien->email = $value->email;
							$sinhvien->khoa = "CNTT";
							$sinhvien->lop = $value->lop;
							$sinhvien->nganh = $value->nganh;
							$sinhvien->ngaysinh = $value->ngaysinh;
							$sinhvien->gioitinh = $value->gioitinh;
							$sinhvien->magiaovien = 0;
							$sinhvien->sinhvien_id = $data['id'];
							$sinhvien->save();
						}	
					}catch (\Exception $e) {
					    return $e->getMessage();
					}
					
				}
			}
		}
		return redirect()->route('giaovu.listsinhvien')->with(['flash_message'=>'Thêm thành công sinh viên']);
	}
}
