<?php

namespace Database\Seeders;

use App\Models\Customer;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class, // UserSeederで作成したダミーデータの呼び出し
            ItemSeeder::class, // ItemSeederで作成したダミーデータの呼び出し
        ]);

        Customer::factory(300)->create(); // CustomerFactoryをもとに300件分のこきゃうのダミーデータの作成
    }
}
