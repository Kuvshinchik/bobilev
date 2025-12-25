<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    /**
     * Дашборд со статистикой и графиком
     */
    public function dashboard()
    {
        // Общая статистика
        $totalWorkers = Worker::count();
        $vaccinatedCount = Worker::where('vakcina', 1)->count();

        // Данные для графика и таблицы по РДЖВ
        $chartData = Worker::select(
                'rdzv',
                DB::raw("COUNT(*) as total"),
                DB::raw("SUM(vakcina) as vaccinated")
            )
            ->groupBy('rdzv')
            ->orderByRaw("CASE WHEN rdzv IS NULL THEN 0 ELSE 1 END, rdzv ASC")
            ->get()
            ->map(function ($item) use ($totalWorkers) {
                $percent = $totalWorkers > 0 
                    ? round(($item->vaccinated / $totalWorkers) * 100, 2) 
                    : 0;
                
                // Процент вакцинированных в этой РДЖВ
                $vaccinatedPercent = $item->total > 0 
                    ? round(($item->vaccinated / $item->total) * 100, 1) 
                    : 0;
                
                // Уровень достижения целевого значения 75%
                $targetLevel = round($vaccinatedPercent / 75, 2);
                
                return [
                    'rdzv' => $item->rdzv ?? 'ОУ ДЖВ',
                    'vaccinated' => (int) $item->vaccinated,
                    'total' => (int) $item->total,
                    'percent' => $percent,
                    'vaccinated_percent' => $vaccinatedPercent,
                    'target_level' => $targetLevel
                ];
            });

        // Общий процент вакцинации
        $totalVaccinatedPercent = $totalWorkers > 0 
            ? round(($vaccinatedCount / $totalWorkers) * 100, 1) 
            : 0;

        return view('worker.dashboard', compact(
            'totalWorkers', 
            'vaccinatedCount', 
            'chartData',
            'totalVaccinatedPercent'
        ));
    }

    /**
     * Отображение таблицы с фильтрами
     */
    public function table(Request $request)
    {
        // Получаем список всех РДЖВ для первого селекта (по алфавиту)
        $rdzvList = Worker::whereNotNull('rdzv')
            ->distinct()
            ->orderBy('rdzv')
            ->pluck('rdzv');

        // Строим запрос с фильтрацией
        $query = Worker::query();

        // Получаем значения фильтров
        $selectedRdzv = $request->input('rdzv', '');
        $selectedVokzal = $request->input('vokzal', '');

        // Применяем фильтр по РДЖВ
        if ($selectedRdzv === 'ou_dzhv') {
            // ОУ ДЖВ: показываем только сотрудников где rdzv = NULL
            $query->whereNull('rdzv');
        } elseif ($selectedRdzv !== '' && $selectedRdzv !== 'all') {
            // Выбрана конкретная РДЖВ
            $query->where('rdzv', $selectedRdzv);

            // Применяем фильтр по вокзалу
            if ($selectedVokzal === 'ou_rdzv') {
                // ОУ РДЖВ: только сотрудники РДЖВ (без вокзала)
                $query->whereNull('vokzal');
            } elseif ($selectedVokzal !== '' && $selectedVokzal !== 'all') {
                // Конкретный вокзал
                $query->where('vokzal', $selectedVokzal);
            }
        }

        // Получаем данные с пагинацией
        $workers = $query->paginate(50)->appends($request->query());

        // Если это AJAX-запрос, возвращаем только таблицу
        if ($request->ajax()) {
            return view('worker.table_body', compact('workers'));
        }

        return view('worker.table', compact('workers', 'rdzvList', 'selectedRdzv', 'selectedVokzal'));
    }

    /**
     * AJAX: Получить список вокзалов по выбранной РДЖВ
     */
    public function getVokzals(Request $request)
    {
        $rdzv = $request->input('rdzv');

        if (!$rdzv) {
            return response()->json([]);
        }

        // Получаем список вокзалов для этой РДЖВ (по алфавиту)
        $vokzalList = Worker::where('rdzv', $rdzv)
            ->whereNotNull('vokzal')
            ->distinct()
            ->orderBy('vokzal')
            ->pluck('vokzal');

        return response()->json($vokzalList);
    }

    public function analytics()
    {
        $statusSiteStats = Worker::selectRaw('statusSite, COUNT(*) as count')
            ->groupBy('statusSite')
            ->get();

        $statusVokzalStats = Worker::selectRaw('statusVokzal, COUNT(*) as count')
            ->groupBy('statusVokzal')
            ->get();

        return view('worker.analytics', compact('statusSiteStats', 'statusVokzalStats'));
    }
}