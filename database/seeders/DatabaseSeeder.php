<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Item;
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

        Customer::factory(300)->create(); // CustomerFactoryをもとに300件分の顧客のダミーデータの作成

        $items = Item::all(); // 全ての商品の取得
        Purchase::factory(500)->create()  // PurchaseFactoryをもとに300件分の購買と商品と購買のダーミーデータの作成
            // each()で300件中のpurchaseデータの1件づつに対して中間テーブルへの登録処理をする
            ->each(function(Purchase $purchase) use ($items){ // use($items)で関数内で$itemsを使用できるようにする
                $purchase->items()->attach( // 中間テーブルへのダミーデータの挿入
                    $items->random(rand(1,3))->pluck('id')->toArray(),
                    [ 'quantity' => rand(1, 5) ]
                );
            });
    }
}
