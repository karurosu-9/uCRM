<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Purchase extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status'
    ];

    // 顧客モデルとのリレーション
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
