<?php

use Illuminate\Database\Seeder;

class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institution')->insert([
            'institution_id' => '1',
            'institution_name' => 'General',
            'status_id' => 1,
            'is_active' => 1,
        ]);
    }
}
