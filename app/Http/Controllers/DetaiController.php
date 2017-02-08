<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Detai;
use App\Giaovien;
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
						// $insert[] = ['giaovien_id' => $value->giaovien_id, 'sinhvien_id' => $value->sinhvien_id,'ten'=>$value->ten,'type'=>$value->type];
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
						$giaovien->khoa = $value->khoa;
						$giaovien->bomon = $value->bomon;
						$giaovien->sdt = $value->sdt;
						$giaovien->sosinhvien = 0;
						$giaovien->giaovien_id = $data['id'];
						$giaovien->save();
					}catch (\Exception $e) {
					    return $e->getMessage();
					}
					
				}
				// if(!empty($insert)){
				// 	DB::table('detais')->insert($insert);
				// 	dd('Insert Record successfully.');
				// }
				dd('Insert Record successfully.');
			}
		}
		return back();
	}
}
