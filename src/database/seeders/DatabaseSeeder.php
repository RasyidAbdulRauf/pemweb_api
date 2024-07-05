<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserSeeder::class,]);
        $this->call([CustomerSeeder::class,]);
        $this->call([ProductSeeder::class]);
        $this->call([OrderSeeder::class]);
        $this->call([OrderItemSeeder::class]);
        $this->call([PaymentSeeder::class]);
    }
}
