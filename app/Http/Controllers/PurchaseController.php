<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::groupBy('id')
                    ->selectRaw('id, sum(subtotal) as total, customer_name, status, created_at') // selectRaw()はsum()などの関数などを使用したい場合に使用する
                    ->paginate(10);

        return Inertia('Purchases/Index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::select('id', 'name', 'price')
            ->where('is_selling', true)->get();

        return Inertia::render('Purchases/Create', [
            'items'     => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();

        try{
            // Purchaseテーブルにレコードの追加
            $purchase = Purchase::create([
                'customer_id' => $request->customer_id,
                'status' => $request->status,
            ]);

            // 中間テーブルにレコードの追加
            foreach ($request->items as $item) {
                $purchase->items()->attach($purchase->id, [
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                ]);
            };

            DB::commit();

            return redirect(route('dashboard'));

        } catch(\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        // 小計 (商品ID、商品名、商品価格、数量、小計)
        $items = Order::where('id', $purchase->id)->get();

        // 合計 (購入日、購入者、合計金額)
        $order = Order::groupBy('id')
                    ->where('id', $purchase->id)
                    ->selectRaw('id, sum(subtotal) as total, customer_name, status, created_at') // selectRaw()はsum()などの関数などを使用したい場合に使用する
                    ->get();

        return Inertia('Purchases/Show', [
            'items' => $items,
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $purchase = Purchase::find($purchase->id);

        // 全ての商品を取得
        $allItems = Item::select('id', 'name', 'price')->get();

        $items = [];
        foreach ($allItems as $allItem) {
            $quantity = 0;
            // 全ての商品からpurchaseIDに紐づく商品だけを取得
            foreach ($purchase->items as $item) { // 中間テーブルに登録されている数量を各商品に格納する
                if ($allItem->id === $item->id) {
                    $quantity = $item->pivot->quantity;
                }
            };
            array_push($items, [
                'id' => $allItem->id,
                'name' => $allItem->name,
                'price' => $allItem->price,
                'quantity' => $quantity
            ]);
        };

        // スコープを利用して顧客情報の取得
        $order = Order::groupBy('id')
                    ->where('id', $purchase->id)
                    ->selectRaw('id, customer_id, customer_name, status, created_at')
                    ->get();

        return Inertia('Purchases/Edit', [
            'items' => $items,
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
