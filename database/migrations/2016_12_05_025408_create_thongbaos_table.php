<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThongbaosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('thongbaos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('tieude');
			$table->string('noidung');
			$table->integer('giaovu_id');
			$table->dateTime('thoigian');
			$table->integer('type');
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
		Schema::drop('thongbaos');
	}

}
