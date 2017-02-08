<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaoviensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('giaoviens', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('magiaovien')->unique();
			$table->string('tengiaovien');
			$table->date('ngaysinh');
			$table->string('quequan');
			$table->integer('gioitinh');
			$table->string('diachi');
			$table->string('chucdanh');
			$table->string('hocham');
			$table->string('hocvi');
			$table->string('khoa');
			$table->string('bomon');
			$table->string('sdt');
			$table->string('email');
			$table->integer('sosinhvien');
			$table->integer('giaovien_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('giaoviens');
	}

}
