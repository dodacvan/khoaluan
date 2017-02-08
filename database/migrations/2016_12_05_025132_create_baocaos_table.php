<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaocaosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('baocaos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('giaovien_id');
			$table->integer('sinhvien_id');
			$table->string('ten');
			$table->string('file');
			$table->string('ghichu');
			$table->string('type');
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
		Schema::drop('baocaos');
	}

}
