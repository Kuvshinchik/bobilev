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
                        <h3 class="mb-0">9 078</h3>
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
                        <h3 class="mb-0">9 047</h3>
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
</style>
@endpush

{{--
<h1>Дашборд</h1>
<p>Всего сотрудников: {{ $totalWorkers }}</p>
<p>Привито: {{ $vaccinatedCount }}</p>
<a href="{{ route('worker.table') }}">К таблице</a> |
<a href="{{ route('worker.analytics') }}">К аналитике</a>
--}}