<?php

use Illuminate\Database\Seeder;

class MemberRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member_roles')->insert([
            'name' => 'Kepala Cabang'
        ]);

        DB::table('member_roles')->insert([
            'name' => 'Sekertaris'
        ]);

        DB::table('member_roles')->insert([
            'name' => 'Anggota'
        ]);
    }
}
