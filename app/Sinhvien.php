<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinhvien extends Model {

	protected $table = 'sinhviens';
	protected $fillable = ['masinhvien','ten','sdt','diachi','email','khoa','lop','nghanh','ngaysinh','gioitinh','magiaovien','sinhvien_id'];

}
