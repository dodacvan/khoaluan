<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Yeucau extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sinhviens', function ($table) {
			$table->integer('sinhvien_id')->unsigned()->change();
		     $table->foreign('sinhvien_id')->references('id')->on('users');
		});
		Schema::table('yeucaus', function ($table) {
		     $table->foreign('sinhvien_id')->references('sinhvien_id')->on('sinhviens');
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
