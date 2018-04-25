<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            [
             'name' 		=> 'superadmin',
             'guard_name'	=> 'web',
             'created_at'	=> Carbon::now()->format('Y-m-d H:i:s'),
             'updated_at'	=> Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
             'name' 		=> 'driver',
             'guard_name'	=> 'web',
             'created_at'	=> Carbon::now()->format('Y-m-d H:i:s'),
             'updated_at'	=> Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
             'name'         => 'manager',
             'guard_name'   => 'web',
             'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
             'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
