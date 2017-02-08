<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Detai extends Model {

	protected $table = 'detais';
	protected $fillable = ['giaovien_id','sinhvien_id','type','ten'];
	
}
