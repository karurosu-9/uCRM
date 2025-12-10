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

        // 日別の処理
        if ($request->type === 'perDay') {
            // list()にすることで、AnalysisService::perDay()から返ってきた値をlist()内の変数に一括で順番に値を入れていく
            list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
        }

        // 月別の処理
        if ($request->type === 'perMonth') {
            // list()にすることで、AnalysisService::perMonth()から返ってきた値をlist()内の変数に一括で順番に値を入れていく
            list($data, $labels, $totals) = AnalysisService::perMonth($subQuery);
        }

        // 年別の処理
        if ($request->type === 'perYear') {
            // list()にすることで、AnalysisService::perYear()から返ってきた値をlist()内の変数に一括で順番に値を入れていく
            list($data, $labels, $totals) = AnalysisService::perYear($subQuery);
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
