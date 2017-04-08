<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\GiaovienRequest;
use App\Http\Requests\SinhvienRequest;
use Illuminate\Http\Request;
use App\Giaovien;
use App\Sinhvien;
use App\User;
use App\Detai;
use App\Yeucau;
use App\Huongnghiencuu;
use Hash;
use Auth;
use Validator;
use DB;
use Response;
use Excel;
use Charts;
use Goutte;

class GiaovuController extends Controller {
	protected $_databaocaogiaovien;

	public function getaddgiaovien()
	{
		return view('giaovu.addgiaovien');
	}

	public function postaddgiaovien(GiaovienRequest $request)
	{
		$user = new User();
		$ten = $this->exname($request->txtName);
		$check = User::select('id')->where('type', 1)->where('name','like',$ten.'%')->get()->toArray();
		$count = count($check);
		 if($count==0){
		 	$user->name = $ten;
		 }else{
		 	$user->name = $ten.$count;
		 }
		$user->email = $request->txtemail;
		$user->password =  Hash::make('123');
		$user->type = 1;
		$user->save();
		
		$data = User::select('name','email','type','id')->where('email',$request->txtemail)->get()->first();
		$giaovien = new Giaovien();
		$giaovien->tengiaovien = $request->txtName;
		$giaovien->email = $data['email'];
		$giaovien->magiaovien = $data['id'];
		$giaovien->ngaysinh = $request->txtBirth;
		$giaovien->quequan = $request->txtProvince;
		$giaovien->gioitinh = $request->txtSex;
		$giaovien->diachi = $request->txtAddress;
		$giaovien->chucdanh = $request->txtTitle;
		$giaovien->hocham = $request->txtAcademic;
		$giaovien->hocvi =$request->txtDegree;
		$giaovien->khoa = 'CNTT';
		$giaovien->bomon = $request->txtSubject;
		$giaovien->sdt = $request->txtCellphone;
		$giaovien->sosinhvien = 0;
		$giaovien->giaovien_id = $data['id'];
		$giaovien->save();

		$dataEmail = "tên tài khoản". $user->name . " mật khẩu là 123";
		$titleEmail = 'Thêm tài khoản giáo viên';
		$this->sendEmail($dataEmail, $titleEmail);
		return redirect()->route('giaovu.listgiaovien')->with(['flash_message'=>'Thêm thành công giáo viên']);
	}

	public function getlistgiaovien(){
		$data = Giaovien::select('*')->orderBy('id','DESC')->get()->toArray();
		return view('giaovu.listgiaovien', compact('data'));
	}

	public function getinfogiaovien($id){
		$data = Giaovien::where('id',$id)->orderBy('id','DESC')->get()->first();
		return view('giaovu.infogiaovien',compact('data'));
	}

	public function getaddsinhvien(){
		return view('giaovu.addsinhvien');
	}

	public function postaddsinhvien(SinhvienRequest $request){
		 $user = new User();
		 $khoa = substr($request->txtClass, 0, 2);
		 $ten = $this->exname($request->txtName);
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
		$user->email = $request->txtemail;
		//$user->password =  Hash::make($this->expass());
		$user->password =  Hash::make('123');
		$user->type = 2;
		$user->save();
				
		$data = User::select('id','name','email','type')->where('email',$request->txtemail)->get()->first();
		$sinhvien = new Sinhvien();
		$sinhvien->masinhvien = $request->txtCode;
		$sinhvien->ten = $request->txtName;
		$sinhvien->sdt = $request->txtCellphone;
		$sinhvien->diachi = $request->txtAddress;
		$sinhvien->email = $request->txtemail;
		$sinhvien->khoa = "CNTT";
		$sinhvien->lop = $request->txtClass;
		$sinhvien->nganh = $request->txtAcademic;
		$sinhvien->ngaysinh = $request->txtBirth;
		$sinhvien->gioitinh = $request->txtSex;
		$sinhvien->magiaovien = 0;
		$sinhvien->sinhvien_id = $data['id'];
		$sinhvien->save();

		$dataEmail = "tên tài khoản". $user->name . " mật khẩu là 123";
		$titleEmail = 'Thêm tài khoản sinh viên';
		$this->sendEmail($dataEmail, $titleEmail);
		return redirect()->route('giaovu.listsinhvien')->with(['flash_message'=>'Thêm thành công sinh viên']);
	}

	public function getlistsinhvien(){
		$data = Sinhvien::select('*')->orderBy('id','DESC')->get()->toArray();
		return view('giaovu.listsinhvien', compact('data'));
	}

	public function getinfosinhvien($id){
		$data = Sinhvien::where('id',$id)->orderBy('id','DESC')->get()->first();
		$giaovien = Giaovien::where('id',$data['magiaovien'])->get()->first();
		return view('giaovu.infosinhvien',compact('data','giaovien'));
	}

	public function addadmin(){
		$user = new User();
		$user->name = 'admin';
		$user->email='admin@vnu.edu.vn';
		$user->password =  Hash::make('123');
		$user->type = 3;
		$user->save();

	}

	public function baocaodetai(){
		$data = $this->getdatabaocao();
		return view('giaovu.baocaodetai',compact('data'));
	}

	public function getdatabaocao(){
		$data = DB::table('yeucaus')->join('sinhviens','yeucaus.sinhvien_id','=','sinhviens.sinhvien_id')->join('giaoviens','yeucaus.giaovien_id','=','giaoviens.id')->select('yeucaus.*','sinhviens.id as svid','sinhviens.ten','giaoviens.tengiaovien','giaoviens.id')->where('yeucaus.status','=',1)->get();
		return $data;
	}

	public function downdetai($type){
		$data = $this->getdatabaocao();
		$data = array_map(function($object){
		    return (array) $object;
		}, $data);
		return Excel::create('danhsachdetai', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

	public function getchart()
    {
    	$data1 = Yeucau::whereIn('status', [1, 4])->count();
    	$data2 = Yeucau::whereIn('status', [2, 5])->count();
    	$data3 = Sinhvien::all()->count();
    	$data3 = $data3 - $data1 - $data2;
        $chart = Charts::create('pie', 'highcharts')
            //->setView('custom.line.chart.view') // Use this if you want to use your own template
            ->setTitle('Thống kê về đăng kí')
            ->setLabels(['Sinh viên đã được giáo viên chấp nhận đã hoàn thiện đề tài', 'Sinh viên đã được giáo viên chấp nhận đề tài đang hoàn thiện', 'Sinh viên chưa đăng kí hoặc chưa được giáo viên chấp nhận'])
            ->setValues([$data1,$data2,$data3])
            ->setDimensions(1000,500)
            ->setResponsive(true);
        return view('giaovu.chart', ['chart' => $chart]);
    }

    public function postBaocaoGV(Request $request)
    {
    	$bomon = array(
            'công nghệ phần mềm',
            'hệ thống thông tin',
            'khoa học máy tính',
            'mạng và truyền thông máy tính',
            'các pp toán trong cn',
            'ptn công nghệ tri thức',
            'ptn hệ thống nhúng',
            'ptn tương tác người máy'
        );
        $bomonselect = $typeselect = "";
    	if($request->bomon){
    		$bomonselect = $request->bomon;
    	}
    	if($request->type){
    		$typeselect = $request->type;
    	}
    	$data = $this->getDataBaocaoGV($request);
    	$request->session()->put('datagiaovien', $data);
		return view('giaovu.baocaogiaovien', compact('data','bomonselect','typeselect','bomon')); 	
    }

    public function getDataBaocaoGV($request)
    {
    	$value = Giaovien::select('id','tengiaovien','sdt','email','hocvi','bomon','sosinhvien','hocham');
    	if($request->bomon){
    		$value = $value->where('bomon','=', $request->bomon);
    	}
    	$value = $value->get()->toArray();
    	$data = array();
		foreach ($value as $items) {
			$check = $this->checkshow($items);
			if($request->type){
				if($check == $request->type){
					$data[] = $items;
				}
			}else{
				$data[] = $items;
			}
		}
		return $data;
    }

    public function downloadExcelGiaovien(Request $request)
	{
		$data = $request->session()->get('datagiaovien');
		return Excel::create('danhsachgiaovien', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download('xls');
	}

	public function getchartgiaovien(){
		$value = Giaovien::select('id','hocvi','sosinhvien','hocham')->get()->toArray();
    	$data = array();
		foreach ($value as $items) {
			$check = $this->checkshow($items);
			if($check == 'true'){
				$data[] = $items;
			}	
		}
		$data1 = count($data);
    	$data2 = count($value) - $data1;
        $chart = Charts::create('pie', 'highcharts')
            //->setView('custom.line.chart.view') // Use this if you want to use your own template
            ->setTitle('Thống kê về giáo viên')
            ->setLabels(['Giáo viên chưa nhận đủ sinh viên', 'Giáo viên nhận đủ sinh viên'])
            ->setValues([$data1,$data2])
            ->setDimensions(1000,500)
            ->setResponsive(true);
        return view('giaovu.chartgiaovien', ['chart' => $chart]);
	}

	public function postBaocaoSV(Request $request)
	{
		$value = DB::table('sinhviens')->leftJoin('yeucaus','yeucaus.sinhvien_id','=','sinhviens.sinhvien_id')->select('sinhviens.id','sinhviens.ten','sinhviens.lop','sinhviens.email','sinhviens.nganh','yeucaus.status');
		$nganh = array(
            'công nghệ thông tin',
            'khoa học máy tính',
            'hệ thống thông tin',
            'truyền thông và mạng máy tính'
        );
		$nganhselect = $typeselect = "";
		if($request->nganh){
			$value = $value->where('nganh','=',$request->nganh);
			$nganhselect = $request->nganh;
		}
		$value = $value->get();
		$value = array_map(function($object){
		    return (array) $object;
		}, $value);
		$data = array();
		foreach ($value as $items) {
			if($items['status'] == 1){
				$items['show'] = "Đã đăng kí thành công";
			} elseif(in_array($items['status'], [2,4,5,6,7])){
				$items['show'] = "Đang hoàn thiện đề tài với giáo viên";
			}else{
				$items['show'] = "Chưa đăng kí thành công";
			}
			unset($items['status']);
			switch ($request->type) {
				case 0:
					$data[] = $items;
					break;
				case 1:
					if($items['show'] == "Đã đăng kí thành công"){
						$data[] = $items;
					}
					$typeselect = $request->type;
					break;
				case 2:
					if($items['show'] == "Đang hoàn thiện đề tài với giáo viên"){
						$data[] = $items;
					}
					$typeselect = $request->type;
					break;
				case 3:
					if($items['show'] == "Chưa đăng kí thành công"){
						$data[] = $items;
					}
					$typeselect = $request->type;
					break;
				default:
					$data[] = $items;
					break;
			}
		}
		$request->session()->put('datasinhvien', $data);
		return view('giaovu.baocaosinhvien',compact('data','nganh','nganhselect','typeselect'));
	}

	public function downloadExcelSinhvien(Request $request)
	{
		$data = $request->session()->get('datasinhvien');
		return Excel::create('danhsachsinhvien', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download('xls');
	}

	public function sendEmailSV(Request $request)
	{
		$validation = Validator::make($request->all(), ['title' => 'required','contentemail'=>'required']);
		if( $validation->fails()){
			 $response = array(
	            'success' => 'false'
	        );
		} else {
			$data = $request->session()->get('datasinhvien');
			foreach ($data as $value) {
				$this->sendEmail($request->contentemail,$request->title);
			}
			 $response = array(
	            'success' => 'true'
	        );
		}

		return response()->json($response);
	}

	public function getCrawler(){
		$crawler = Goutte::request('GET', 'http://fit.uet.vnu.edu.vn/gioi-thieu/giang-vien/');
		$data = array();
	    $crawler->filter('tbody tr')->each(function ($node) {
	      	$ten = $node->filter('a')->text();
	      	$nghiencuu = $node->filter('td:last-child')->text();
	      	$arrayhnc = explode(',',$nghiencuu);
	    	$listgv = Giaovien::where('tengiaovien','=',$ten)->get()->toArray();
	    	if(!empty($listgv)){
	    		foreach ($listgv as $gv) {
		    		$check = Huongnghiencuu::where('giaovien_id',$gv['id'])->where('ten',$nghiencuu)->get()->toArray();
		    		if(empty($check)){
		    			foreach ($arrayhnc as $value) {
		    				$hnc = new Huongnghiencuu();
			    			$hnc->giaovien_id = $gv['id'];
			    			$hnc->ten = $value;
			    			$hnc->save();
		    			}	
		    		}
		    	}
	    	}
	    });
	    return redirect()->back()->with(['flash_message'=>'Cập nhập thông tin thành công']);
	}

}
