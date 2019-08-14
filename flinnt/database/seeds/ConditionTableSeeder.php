<?php

use Illuminate\Database\Seeder;

class ConditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('condition')->insert([
       		'condition_id' => '1',
    		'condition_name' => 'Free condition',
    		'is_active' => '1',
        ]);
    }
}
