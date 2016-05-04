<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserRolePermSeeder::class);
        $this->call(LaravelShopSeeder::class);
        $this->call(CategoriesSeeder::class);

        Model::reguard();
    }
}
