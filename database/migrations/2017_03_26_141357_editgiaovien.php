<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Editgiaovien extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::table('giaoviens', function ($table) {
			$table->string('quequan')->nullable()->default("Hà Nội")->change();
			$table->string('diachi')->nullable()->default("Hà Nội")->change();
			$table->string('chucdanh')->nullable()->default("GV")->change();
			$table->string('hocham')->nullable()->default("")->change();
			$table->string('hocvi')->nullable()->default("")->change();
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
