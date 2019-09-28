<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'    => 'Abdul',
            'last_name'     => 'Awal',
            'user_name'     => 'ashu100',
            'email'         => 'awal.ashu@gmail.com',
            'password'      => bcrypt('123456'),
            'is_active'     => 1,
        ]);
    }
}
