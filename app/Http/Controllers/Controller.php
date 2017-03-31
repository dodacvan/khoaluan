<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Sinhvien;
use Mail;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
	
	public function exname($name){
		$str = trim($name);
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
		  $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
		  $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
		  $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
		  $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
		  $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
		  $str = preg_replace("/(đ)/", "d", $str);
		  $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
		  $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
		  $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
		  $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
		  $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
		  $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
		  $str = preg_replace("/(Đ)/", "D", $str);
		$array 	= explode(" ", $str);
		$length = count($array);
		$value = $array[$length-1];
		for ($i=0;$i<$length-1;$i++){
			$value= $value.substr($array[$i],0, 1);
		}
		$value = strtolower($value);
		return $value;
	}

	public function expass(){
		$password = '';
	   $possible = '23456789bcdfghjkmnpqrstvwxyz';
	   $i = 0;$length=6;
	   while ($i < $length) {
	      $password .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
	      $i++;
	   } 
	   return $password;
	}

	public function checkshow($giaovien){
		switch ($giaovien['hocvi']) {
            case "":
                $number = 0;
                break;
            case "CN":
                $number = 0;
                break;
            case "Ths":
                $number = 3;
                break;
            default:
                $number = 5;
                break;
        }
        $check = 'true';
        if($number <= $giaovien['sosinhvien']){
        	$check = 'false';
        }
        return $check;
	}

	public function sendEmail($data, $title){
		$dataEmail = array('data'=>$data);
		Mail::send('emails.contact',$dataEmail, function($msg) use($title){
			$msg->from('dodacvan1995@gmail.com','van');
			$msg->to('dodacvan1995@gmail.com','nguoi dung moi')->subject($title);

		});
	}
}
