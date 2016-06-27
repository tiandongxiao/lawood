<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {

        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'email' 	 => 'admin@lawood.cn',
                'password' 	 => bcrypt('20022002'),
                'role'       => 'admin'
            ]
        ]);
    }
}
