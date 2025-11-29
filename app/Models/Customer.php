<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    public function scopeSearchCustomers($query, $input = null)
    {
        if(!empty($input)) {
            return $query->where('kana', 'like', $input . '%')
                    ->orWhere('tel', 'like', $input . '%');
        }
    }
}
