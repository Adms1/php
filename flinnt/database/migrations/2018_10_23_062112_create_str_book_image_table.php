<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrBookImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_image', function(Blueprint $table)
		{
			$table->bigInteger('book_image_id', true)->unsigned();
			$table->bigInteger('book_id')->unsigned();
			$table->string('book_image_name', 100);
			$table->string('book_image_path', 1000);
			$table->integer('book_image_order');
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
		Schema::drop('str_book_image');
	}

}
