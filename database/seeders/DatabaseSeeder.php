<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
                UserSeeder::class,           // 1. まず親（ユーザー）を作る
                SimulatedTradeSeeder::class, // 2. 次に子（取引データ）を作る
        ]);
    }
}
