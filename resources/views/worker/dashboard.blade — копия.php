@extends('layouts.admin')

@section('title', 'Дашборд')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-flex align-items-center">
            <a href="{{ route('home') }}" class="logo mr-3" style="font-size: 24px; color: #5b73e8; text-decoration: none;">
                <i class="mdi mdi-assistant"></i> ДЖВ
            </a>
            <h4 class="page-title mb-0">Дашборд</h4>
        </div>
    </div>
</div>

<!-- Статистика -->
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="mdi mdi-account-multiple mdi-36px text-primary"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Всего сотрудников</h5>
                        <h3 class="mb-0">{{ number_format($totalWorkers, 0, '', ' ') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="mdi mdi-needle mdi-36px text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Привито</h5>
                        <h3 class="mb-0">{{ number_format($vaccinatedCount, 0, '', ' ') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card m-b-30">
            <div class="card-body">
                <a href="{{ route('worker.table') }}" class="d-flex align-items-center text-dark">
                    <div class="mr-3">
                        <i class="mdi mdi-table-large mdi-36px text-info"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">ПЕРЕЙТИ</h5>
                        <h3 class="mb-0">к таблице</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card m-b-30">
            <div class="card-body">
                <a href="{{ route('worker.analytics') }}" class="d-flex align-items-center text-dark">
                    <div class="mr-3">
                        <i class="mdi mdi-chart-bar mdi-36px text-warning"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">ПЕРЕЙТИ</h5>
                        <h3 class="mb-0">к аналитике</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- График: Вакцинация по РДЖВ -->
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">
                    <i class="mdi mdi-chart-bar text-primary mr-2"></i>
                    Вакцинация по РДЖВ
                </h4>
                <p class="text-muted mb-4">
                    Количество вакцинированных сотрудников по каждой РДЖВ. 
                    При наведении отображается процент от общего числа сотрудников.
                </p>
                
                {{-- Контейнер для графика Morris --}}
                <div id="vaccination-chart" style="height: 420px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Таблица: Вакцинация по РДЖВ -->
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">
                    <i class="mdi mdi-table-large text-primary mr-2"></i>
                    Сводная таблица вакцинации
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" style="width: 50px;">№ п/п</th>
                                <th>Наименование РДЖВ</th>
                                <th class="text-center">Численность<br>работников (чел.)</th>
                                <th class="text-center">Прошли<br>вакцинацию (чел.)</th>
                                <th class="text-center">% вакцини-<br>рованных</th>
                                <th class="text-center">Уровень достижения<br>целевого значения 75%</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Итоговая строка по всему ДЖВ --}}
                            <tr class="table-primary font-weight-bold">
                                <td class="text-center">—</td>
                                <td><strong>ВСЕГО по ДЖВ</strong></td>
                                <td class="text-center">{{ number_format($totalWorkers, 0, '', ' ') }}</td>
                                <td class="text-center">{{ number_format($vaccinatedCount, 0, '', ' ') }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $totalVaccinatedPercent >= 75 ? 'badge-success' : 'badge-warning' }} px-2 py-1">
                                        {{ $totalVaccinatedPercent }}%
                                    </span>
                                </td>
                                <td class="text-center">
                                    @php $totalTargetLevel = round($totalVaccinatedPercent / 75, 2); @endphp
                                    <span class="badge {{ $totalTargetLevel >= 1 ? 'badge-success' : 'badge-warning' }} px-2 py-1">
                                        {{ $totalTargetLevel }}
                                    </span>
                                </td>
                            </tr>
                            
                            {{-- Данные по каждой РДЖВ --}}
                            @foreach($chartData as $index => $row)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $row['rdzv'] }}</td>
                                <td class="text-center">{{ number_format($row['total'], 0, '', ' ') }}</td>
                                <td class="text-center">{{ number_format($row['vaccinated'], 0, '', ' ') }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $row['vaccinated_percent'] >= 75 ? 'badge-success' : ($row['vaccinated_percent'] >= 50 ? 'badge-warning' : 'badge-danger') }} px-2 py-1">
                                        {{ $row['vaccinated_percent'] }}%
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $row['target_level'] >= 1 ? 'badge-success' : ($row['target_level'] >= 0.7 ? 'badge-warning' : 'badge-danger') }} px-2 py-1">
                                        {{ $row['target_level'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    <small class="text-muted">
                        <i class="mdi mdi-information-outline mr-1"></i>
                        Целевое значение вакцинации — 75%. 
                        Уровень достижения = % вакцинированных / 75%.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .nav-btn {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        min-height: 150px;
        white-space: normal;
    }
    
    .nav-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    
    .nav-btn span {
        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
    }
    
    .mdi-36px {
        font-size: 36px;
    }
    
    .logo:hover {
        opacity: 0.8;
    }

    /* Стили для подсказки Morris */
    .morris-hover {
        position: absolute;
        z-index: 1000;
        padding: 10px 15px;
        background-color: #333;
        color: #fff;
        border-radius: 5px;
        font-size: 13px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    
    .morris-hover .morris-hover-row-label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #5b73e8;
    }
    
    .morris-hover .morris-hover-point {
        margin: 3px 0;
    }
</style>
@endpush

@push('scripts')
{{-- Raphael.js - обязательная зависимость для Morris --}}
<script src="{{ asset('assets/plugins/morris/raphael-min.js') }}"></script>
{{-- Morris.js --}}
<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>

<script>
$(function() {
    // Данные для графика из контроллера
    var chartData = @json($chartData);
    
    // Создаём столбчатую диаграмму Morris
    var chart = Morris.Bar({
        // ID элемента, куда вставить график
        element: 'vaccination-chart',
        
        // Данные для графика
        data: chartData,
        
        // Ключ для оси X (название РДЖВ)
        xkey: 'rdzv',
        
        // Ключи для оси Y (вакцинированные)
        ykeys: ['vaccinated'],
        
        // Подписи для легенды
        labels: ['Вакцинировано'],
        
        // Цвет столбцов
        barColors: ['#5b73e8'],
        
        // Скругление столбцов
        barRadius: [5, 5, 0, 0],
        
        // Отступ между столбцами
        barGap: 5,
        barSizeRatio: 0.6,
        
        // Сетка
        grid: true,
        gridTextSize: 10,
        gridTextColor: '#888',
        
        // Поворот подписей на оси X (в градусах)
        xLabelAngle: 45,
        
        // Отступ для подписей оси X
        xLabelMargin: 15,
        
        // Отступ снизу для повёрнутых подписей
        padding: 60,
        
        // Изменение размера при ресайзе
        resize: true,
        
        // Кастомная подсказка при наведении
        hoverCallback: function(index, options, content, row) {
            return '<div class="morris-hover-row-label">' + row.rdzv + '</div>' +
                   '<div class="morris-hover-point">Вакцинировано: <b>' + row.vaccinated + '</b> чел.</div>' +
                   '<div class="morris-hover-point">Всего в РДЖВ: <b>' + row.total + '</b> чел.</div>' +
                   '<div class="morris-hover-point">Процент от общего: <b>' + row.percent + '%</b></div>';
        }
    });

    // Принудительно показываем все подписи на оси X
    $('#vaccination-chart svg text').each(function() {
        $(this).css('display', 'block');
    });
});
</script>
@endpush