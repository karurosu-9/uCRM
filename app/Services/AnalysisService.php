<?php

namespace App\Services;

class AnalysisService
{
    // 日別処理
    public static function perDay($subQuery)
    {
         // 日別のデータの集計
            $data = $subQuery
                    ->where('status', true)
                    ->selectRaw('DATE_FORMAT(created_at, "%Y%m%d") as date, SUM(subtotal) as total') // 「%Y%m%d」は取得した時間の対象は「00:00:00」なので注意
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

            // グラフに表示する「日」の取得
            $labels = $data->pluck('date');

            // グラフに表示する「金額」の取得
            $totals = $data->pluck('total');

            return [$data, $labels, $totals];
    }

    // 月別処理
    public static function perMonth($subQuery)
    {
         // 月別のデータの集計
            $data = $subQuery
                    ->where('status', true)
                    ->selectRaw('DATE_FORMAT(created_at, "%Y%m") as date, SUM(subtotal) as total') // 「%Y%m%d」は取得した時間の対象は「00:00:00」なので注意
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

            // グラフに表示する「日」の取得
            $labels = $data->pluck('date');

            // グラフに表示する「金額」の取得
            $totals = $data->pluck('total');

            return [$data, $labels, $totals];
    }

    // 年別処理
    public static function perYear($subQuery)
    {
         // 年別のデータの集計
            $data = $subQuery
                    ->where('status', true)
                    ->selectRaw('DATE_FORMAT(created_at, "%Y") as date, SUM(subtotal) as total') // 「%Y%m%d」は取得した時間の対象は「00:00:00」なので注意
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

            // グラフに表示する「日」の取得
            $labels = $data->pluck('date');

            // グラフに表示する「金額」の取得
            $totals = $data->pluck('total');

            return [$data, $labels, $totals];
    }
}
