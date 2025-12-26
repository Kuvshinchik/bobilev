@extends('layouts.admin')

@section('title', 'Аналитика')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-flex align-items-center">
            <a href="{{ route('home') }}" class="logo mr-3" style="font-size: 24px; color: #5b73e8; text-decoration: none;">
                <i class="mdi mdi-assistant"></i> ДЖВ
            </a>
            <h4 class="page-title mb-0">Аналитика</h4>
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
</div>

<!-- Статистика по statusSite -->
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">
                    <i class="mdi mdi-web text-primary mr-2"></i>
                    Статистика по status
                </h4>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Статус</th>
                                <th class="text-right">Количество</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statusSiteStats as $item)
                            <tr>
                                <td>
                                    <span class="badge badge-soft-primary px-2 py-1">{{ $item->status }}</span>
                                </td>
                                <td class="text-right">
                                    <strong>{{ number_format($item->count, 0, ',', ' ') }}</strong> чел.
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Статистика по statusVokzal -->
    <div class="col-lg-6">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">
                    <i class="mdi mdi-train text-success mr-2"></i>
                    Статистика по statusVokzal
                </h4>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Статус</th>
                                <th class="text-right">Количество</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statusVokzalStats as $item)
                            <tr>
                                <td>
                                    <span class="badge badge-soft-success px-2 py-1">{{ $item->statusVokzal }}</span>
                                </td>
                                <td class="text-right">
                                    <strong>{{ number_format($item->count, 0, ',', ' ') }}</strong> чел.
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
    
    .badge-soft-success {
        background-color: rgba(29, 201, 183, 0.15);
        color: #1dc9b7;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endpush





{{--

<h1>Аналитика</h1>

<h2>Статистика по status</h2>
<ul>
@foreach($statusSiteStats as $item)
    <li>Статус {{ $item->status }}: {{ $item->count }} чел.</li>
@endforeach
</ul>

<h2>Статистика по statusVokzal</h2>
<ul>
@foreach($statusVokzalStats as $item)
    <li>Статус {{ $item->statusVokzal }}: {{ $item->count }} чел.</li>
@endforeach
</ul>

<a href="{{ route('worker.dashboard') }}">Назад к дашборду</a> |
<a href="{{ route('worker.table') }}">К таблице</a>

--}}