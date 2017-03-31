<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Lichhen extends Model {

	protected $table = 'lichhens';
	protected $fillable = ['giaovien_id','sinhvien_id','tieude','thoigian','diadiem','type'];

}
