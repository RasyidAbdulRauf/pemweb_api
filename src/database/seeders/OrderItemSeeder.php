<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timstamp = \Carbon\Carbon::now()->toDateString();
        DB::table('order_items')->insert([
            'order_id' => 1,
            'product_id' =>1,
            'quantity' =>1,
            'created_at' => $timstamp,
            'updated_at' => $timstamp,
        ]);
    }
}
