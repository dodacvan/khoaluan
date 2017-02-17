<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Huongnghiencuu extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('huongnghiencuus', function ($table) {
			$table->integer('giaovien_id')->unsigned()->change();
		     $table->foreign('giaovien_id')->references('id')->on('giaoviens');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
