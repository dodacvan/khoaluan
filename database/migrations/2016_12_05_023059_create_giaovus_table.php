<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaovusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('giaovus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('email')->unique();
			$table->integer('magiaovu')->unique();
			$table->string('ten');
			$table->string('diachi');
			$table->string('sdt');
			$table->integer('giaovu_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('giaovus');
	}

}
