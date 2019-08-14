<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrCategoryTreeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_tree', function(Blueprint $table)
		{
			$table->increments('category_tree_id');
			$table->integer('child_category_id')->unsigned()->index('FK_category_tree_child_category_id');
			$table->integer('parent_category_id')->unsigned();
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
		Schema::drop('str_category_tree');
	}

}
