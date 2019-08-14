<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStrCategoryTreeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('category_tree', function(Blueprint $table)
		{
			$table->foreign('child_category_id', 'FK_category_tree_child_category_id')->references('category_id')->on('category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('category_tree', function(Blueprint $table)
		{
			$table->dropForeign('FK_category_tree_child_category_id');
		});
	}

}
