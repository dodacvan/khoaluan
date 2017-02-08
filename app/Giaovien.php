<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Giaovien extends Model {

	protected $table = 'giaoviens';
	protected $fillable = ['magiaovien','tengiaovien','ngaysinh','quequan','gioitinh','diachi','chucdanh','hocham','hocvi','khoa','bomon','sdt','email','sodinhvien','giaovien_id'];
	
}
