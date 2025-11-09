@extends('layouts.app')

@section('title', 'Зима/Лето — Дашборд')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

{{-- Доп. стили только для этой страницы --}}
@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/custom-dashboard.css') }}"> --}}
@endpush

@section('content')
    <div class="row">
        {{-- Сюда перенеси карточки, графики и прочее из старого index --}}
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h5 class="header-title pb-3 mt-0">ДЖВ СВОД</h5>
                    <div id="multi-line-chart" style="height:400px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Верни специфичные для дашборда скрипты, если они реально нужны на этой странице --}}
    <script src="{{ asset('assets/pages/dashborad.js') }}"></script>
    <script src="{{ asset('assets/pages/dashboard-itog.js') }}"></script>
@endpush
