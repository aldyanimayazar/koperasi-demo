<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => 'DPP',
            'slug' => 'dpp',
        ]);

        DB::table('groups')->insert([
            'name' => 'DPD',
            'slug' => 'dpd',
        ]);

        DB::table('groups')->insert([
            'name' => 'DPC',
            'slug' => 'dpc',
        ]);
    }
}
