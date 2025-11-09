<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * GET /dashboard/itog-dzhv?date=YYYY-MM-DD
     * Возвращает агрегат (plan/fact) по категориям за дату.
     */
    public function itogDzhv(Request $request)
    {
        $reportDate = $request->get('date', '2025-11-08');

        $rows = DB::table('preparation_data as pd')
            ->join('object_categories as oc', 'pd.object_category_id', '=', 'oc.id')
            ->whereNull('oc.parent_id') // <-- если нужно только верхний уровень, раскомментируйте
            ->where('pd.report_date', $reportDate)
            ->select(
                'oc.id',
                'oc.name',
                DB::raw('SUM(pd.plan_value) as plan'),
                DB::raw('SUM(pd.fact_value) as fact'),
                'oc.sort_order'
            )
            ->groupBy('oc.id', 'oc.name', 'oc.sort_order')
            ->orderBy('oc.sort_order')
            ->get();

        return response()->json($rows);
    }
}
