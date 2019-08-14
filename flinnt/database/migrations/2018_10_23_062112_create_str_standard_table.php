<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrStandardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('standard', function(Blueprint $table)
		{
			$table->integer('standard_id', true);
			$table->string('standard_name', 100);
			$table->boolean('is_active')->default(1)->comment('1 = Active, 0 = Inactive');
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
		Schema::drop('str_standard');
	}

}
