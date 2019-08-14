<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrBookReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_review', function(Blueprint $table)
		{
			$table->bigInteger('book_review_id', true)->unsigned();
			$table->bigInteger('book_id')->unsigned();
			$table->bigInteger('customer_id')->unsigned();
			$table->text('book_review', 65535);
			$table->integer('book_stars');
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
		Schema::drop('str_book_review');
	}

}
