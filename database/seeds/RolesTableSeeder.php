<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
        ['role_name' => 'Administrator'],
        ['role_name' => 'Agent'],
        ['role_name' => 'Customer'],
      ]);
    }
}
