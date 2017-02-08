<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLichhensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lichhens', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('giaovien_id');
			$table->integer('sinhvien_id');
			$table->string('tieude');
			$table->dateTime('thoigian');
			$table->string('diadiem');
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
		Schema::drop('lichhens');
	}

}
