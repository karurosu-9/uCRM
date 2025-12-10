<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Subtotal;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new Subtotal);
    }

    // 日付指定のスコープ
    public function scopeBetweenDate($query, $startDate = null, $endDate = null)
    {
        if (is_null($startDate) && is_null($endDate)) {
            return $query;
        }

        if (!is_null($startDate) && is_null($endDate)) {
            return $query->where('created_at', '>=', $startDate);
        }

        // endDateは選択した日付の「00:00:00」となってしまうため、選択した日付のデータが取得できない。addDay(1)とすることで翌日の「00:00:00」までにする
        if (is_null($startDate) && !is_null($endDate)) {
            $endDate1 = Carbon::parse($endDate)->addDay(1);
            return $query->where('created_at', '<=', $endDate1);
        }

        // endDateは選択した日付の「00:00:00」となってしまうため、選択した日付のデータが取得できない。addDay(1)とすることで翌日の「00:00:00」までにする
        if (!is_null($startDate) && !is_null($endDate)) {
            $endDate1 = Carbon::parse($endDate)->addDay(1);
            return $query->where('created_at', '>=', $startDate)
                            ->where('created_at', '<=', $endDate1);
        }
    }
}
