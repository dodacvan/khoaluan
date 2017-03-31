<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Thoigian extends Model {

	protected $table = 'thoigians';
	protected $fillable = ['thoigianbatdau','thoigianketthuc','status'];
}
