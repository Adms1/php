<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStrVendorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendor', function(Blueprint $table)
		{
			$table->bigInteger('vendor_id', true);
			$table->string('vendor_name', 500);
			$table->string('email', 55);
			$table->string('password', 191);
			$table->string('remember_token', 100)->nullable();
			$table->string('vendor_address1', 1000)->nullable();
			$table->string('vendor_address2', 1000)->nullable();
			$table->string('vendor_city', 75);
			$table->bigInteger('vendor_state_id');
			$table->integer('vendor_country_id');
			$table->integer('vendor_status_id');
			$table->string('vendor_pin', 15)->nullable();
			$table->string('vendor_gst_number', 100)->nullable();
			$table->string('vendor_phone', 15)->nullable();
			$table->boolean('is_active')->default(1)->comment('1 = Active, 0 = Inactive');
			$table->dateTime('email_verified_at')->nullable();
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
		Schema::drop('str_vendor');
	}

}
