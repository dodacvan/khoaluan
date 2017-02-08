<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinhviensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sinhviens', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('masinhvien')->unique();
			$table->string('ten');
			$table->string('sdt');
			$table->string('diachi');
			$table->string('email');
			$table->string('khoa');
			$table->string('lop');
			$table->string('nganh');
			$table->date('ngaysinh');
			$table->integer('gioitinh');
			$table->integer('magiaovien');
			$table->integer('sinhvien_id');
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
		Schema::drop('sinhviens');
	}

}
