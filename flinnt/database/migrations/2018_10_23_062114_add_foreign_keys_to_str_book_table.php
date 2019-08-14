<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStrBookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('book', function(Blueprint $table)
		{
			$table->foreign('language_id', 'FK_book_language_language_id')->references('language_id')->on('language')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('publisher_id', 'FK_book_publisher_publisher_id')->references('publisher_id')->on('publisher')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('book', function(Blueprint $table)
		{
			$table->dropForeign('FK_book_language_language_id');
			$table->dropForeign('FK_book_publisher_publisher_id');
		});
	}

}
