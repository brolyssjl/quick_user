<?php

use Illuminate\Database\Seeder;
use QuickUser\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(User::class, 5)->create();
    }
}
