<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hocvien extends Model {
	protected $table = 'hocviens';
	protected $fillable = ['mahocvien','tenhocvien','ngaysinh','diachi','gioitinh','sdt','email','magiaovien'];

}
