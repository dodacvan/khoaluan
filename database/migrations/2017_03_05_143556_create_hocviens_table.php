<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHocviensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hocviens', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('mahocvien');
			$table->string('tenhocvien');
			$table->date('ngaysinh');
			$table->string('diachi');
			$table->integer('gioitinh');
			$table->string('sdt');
			$table->string('email');
			$table->integer('magiaovien');
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
		Schema::drop('hocviens');
	}

}
