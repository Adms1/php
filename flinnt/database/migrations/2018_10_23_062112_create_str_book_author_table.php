<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrBookAuthorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_author', function(Blueprint $table)
		{
			$table->bigInteger('book_author_id', true)->unsigned();
			$table->bigInteger('book_id')->unsigned();
			$table->bigInteger('author_id')->unsigned();
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
		Schema::drop('str_book_author');
	}

}
