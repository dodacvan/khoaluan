<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Yeucau extends Model {

	protected $table = 'yeucaus';
	protected $fillable = ['giaovien_id','sinhvien_id','status'];
	

}
