<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        $subQuery = Order::betweenDate($request->startDate, $request->endDate);

        if ($request->type === 'perDay') {
            $data = $subQuery
                    ->where('status', true)
                    ->selectRaw('DATE_FORMAT(created_at, "%Y%m%d") as date, SUM(subtotal) as total') // 「%Y%m%d」は取得した時間の対象は「00:00:00」なので注意
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
        }
        //　値をjsonで返す処理は、Resourceクラスを使用して値をjsonで返すようにしてもOK
        return response()->json([
            'data' => $data,
            'type' => $request->type
        ], Response::HTTP_OK);
    }
}
