<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\AnalysisService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        $subQuery = Order::betweenDate($request->startDate, $request->endDate);

        if ($request->type === 'perDay') {
            // list()にすることで、AnalysisService::perDay()から返ってきた値をlist()内の変数に一括で順番に値を入れていく
            list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
        }

        //　値をjsonで返す処理は、Resourceクラスを使用して値をjsonで返すようにしてもOK
        return response()->json([
            'data' => $data,
            'type' => $request->type,
            'labels' => $labels,
            'totals' => $totals
        ], Response::HTTP_OK);
    }
}
