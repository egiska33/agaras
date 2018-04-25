<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Agaras admin',
            'email' => 'admin@agaras.lt',
            'password' => bcrypt('agaras456'),
            'phone' => '+37045031458',
            'plate' => 'AAA000',
            'position' => 'Position'
        ]);
    }
}
