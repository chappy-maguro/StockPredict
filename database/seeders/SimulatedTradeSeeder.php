<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SimulatedTradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('simulated_trades')->insert([
            'user_id' => 1,           // 最初のユーザー
            'stock_code' => '7203.T', // トヨタの銘柄コード
            'bought_price' => 500.00, // 買った時の価格
            'quantity' => 10,         // 10株
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
