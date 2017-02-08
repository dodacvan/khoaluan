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
					$insert[] = ['giaovien_id' => $value->giaovien_id, 'sinhvien_id' => $value->sinhvien_id,'ten'=>$value->ten ,'type'=> $value->type];
				}
				if(!empty($insert)){
					DB::table('detais')->insert($insert);
					dd('Insert Record successfully.');
				}
			}
		}
		return back();
	}
}
