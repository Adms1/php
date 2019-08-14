<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrBookCategoryTreeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_category_tree', function(Blueprint $table)
		{
			$table->bigInteger('book_category_tree_id', true)->unsigned();
			$table->bigInteger('category_tree_id')->unsigned();
			$table->bigInteger('book_id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('str_book_category_tree');
	}

}
