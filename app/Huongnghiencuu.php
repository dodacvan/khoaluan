<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Huongnghiencuu extends Model {

	protected $table = 'huongnghiencuus';
	protected $fillable = ['ten','giaovien_id'];
}
