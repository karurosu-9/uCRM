<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = ['name', 'memo', 'price', 'is_selling'];

    // 購買モデルとのリレーション
    public function purchases()
    {
        return $this->belongsToMany(Purchase::class)->withPivot('quantity'); // withPivot('quantity')とすることで中間テーブルにしかないカラムを取得することができるようになる
    }
}
