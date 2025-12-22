@extends('layouts.admin')

@section('title', 'Таблица сотрудников')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-flex align-items-center">
            <a href="{{ route('home') }}" class="logo mr-3" style="font-size: 24px; color: #5b73e8; text-decoration: none;">
                <i class="mdi mdi-assistant"></i> ДЖВ
            </a>
            <h4 class="page-title mb-0">Таблица сотрудников</h4>
        </div>
    </div>
</div>

<!-- Навигация -->
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card m-b-30">
            <div class="card-body">
                <a href="{{ route('worker.dashboard') }}" class="d-flex align-items-center text-dark">
                    <div class="mr-3">
                        <i class="mdi mdi-arrow-left-circle mdi-36px text-primary"></i>
                    </div>
                    <div>
                        <h5 class="mb-0">НАЗАД</h5>
                        <h3 class="mb-0">к дашборду</h3>
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

<!-- Таблица сотрудников -->
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">
                    <i class="mdi mdi-account-group text-primary mr-2"></i>
                    Список сотрудников
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Табельный</th>
                                <th>Статус на сайте</th>
                                <th>Статус в ДЖВ</th>
                                <th>Вокзал</th>
                                <th>РДЖВ</th>
                                <th>ДЖВ</th>
                                <th class="text-center">Вакцинация</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($workers as $worker)
                            <tr>
                                <td>
                                    <strong>{{ $worker->tabelNumber }}</strong>
                                </td>
                                <td>
                                    <span class="badge badge-soft-primary px-2 py-1">{{ $worker->statusSite }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-soft-info px-2 py-1">{{ $worker->statusVokzal }}</span>
                                </td>
                                <td>{{ $worker->vokzal ?? '—' }}</td>
                                <td>{{ $worker->rdzv ?? '—' }}</td>
                                <td>{{ $worker->dzv ?? '—' }}</td>
                                <td class="text-center">
                                    @if($worker->vakcina)
                                        <span class="badge badge-success"><i class="mdi mdi-check"></i> Да</span>
                                    @else
                                        <span class="badge badge-danger"><i class="mdi mdi-close"></i> Нет</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if(method_exists($workers, 'links'))
                <div class="mt-4 d-flex justify-content-center">
                    {{ $workers->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .mdi-36px {
        font-size: 36px;
    }
    
    .logo:hover {
        opacity: 0.8;
    }
    
    .badge-soft-primary {
        background-color: rgba(91, 115, 232, 0.15);
        color: #5b73e8;
    }
    
    .badge-soft-info {
        background-color: rgba(23, 162, 184, 0.15);
        color: #17a2b8;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.04);
    }
    
    .thead-dark th {
        background-color: #343a40;
        color: #fff;
        border-color: #454d55;
    }
</style>
@endpush



{{--

<h1>Таблица сотрудников</h1>
<table border="1">
    <thead>
        <tr>
            <th>Табельный №</th>
            <th>Статус Site</th>
            <th>Статус Вокзал</th>
            <th>Вокзал</th>
            <th>РДЗВ</th>
            <th>ДЗВ</th>
            <th>Вакцина</th>
        </tr>
    </thead>
    <tbody>
        @foreach($workers as $worker)
        <tr>
            <td>{{ $worker->tabelNumber }}</td>
            <td>{{ $worker->statusSite }}</td>
            <td>{{ $worker->statusVokzal }}</td>
            <td>{{ $worker->vokzal ?? '—' }}</td>
            <td>{{ $worker->rdzv ?? '—' }}</td>
            <td>{{ $worker->dzv ?? '—' }}</td>
            <td>{{ $worker->vakcina ? 'Да' : 'Нет' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('worker.dashboard') }}">Назад к дашборду</a> |
<a href="{{ route('worker.analytics') }}">К аналитике</a>

--}}