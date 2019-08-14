<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrBookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book', function(Blueprint $table)
		{
			$table->bigInteger('book_id', true)->unsigned();
			$table->integer('publisher_id')->unsigned()->index('FK_book_publisher_publisher_id');
			$table->integer('covertype_id')->unsigned()->nullable();
			$table->integer('language_id')->unsigned()->nullable()->index('FK_book_language_language_id');
			$table->string('book_name', 100);
			$table->string('isbn', 40)->nullable();
			$table->string('series', 100)->nullable();
			$table->string('book_guid', 100);
			$table->string('hs_code', 40)->nullable();
			$table->boolean('is_active')->default(1)->comment('1 = Active, 0 = Inactive');
			$table->boolean('is_academic')->default(1)->comment('1 = Active, 0 = Inactive');
			$table->decimal('book_width', 10, 0)->nullable();
			$table->decimal('book_length', 10, 0)->nullable();
			$table->decimal('book_height', 10, 0)->nullable();
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
		Schema::drop('str_book');
	}

}
