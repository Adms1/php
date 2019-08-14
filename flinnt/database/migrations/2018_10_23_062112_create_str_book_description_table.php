<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrBookDescriptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_description', function(Blueprint $table)
		{
			$table->bigInteger('book_description_id', true)->unsigned();
			$table->bigInteger('book_id')->unsigned();
			$table->text('description', 65535);
			$table->integer('description_order');
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
		Schema::drop('str_book_description');
	}

}
