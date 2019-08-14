<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrAuthorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('author', function(Blueprint $table)
		{
			$table->increments('author_id');
			$table->string('author_name', 191);
			$table->text('about_author', 65535)->nullable();
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
		Schema::drop('str_author');
	}

}
