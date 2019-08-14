<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
        	[
        		'status_id' => '1',
        		'status_name' => 'Active',
        	],
        	[
        		'status_id' => '2',
        		'status_name' => 'Pending',
        	],
        	[
        		'status_id' => '3',
        		'status_name' => 'Rejected',
        	],
        ]);
    }
}
