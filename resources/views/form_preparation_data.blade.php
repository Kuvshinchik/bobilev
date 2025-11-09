@extends('layouts.app') {{-- если у тебя другой лэйаут — поправь --}}

@section('content')
<div class="container">
    <h1>Добавить запись в preparation_data</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('preparation-data.store') }}">
        @csrf

        {{-- Станция --}}
        <div class="mb-3">
            <label for="station_id" class="form-label">Станция</label>
            <select id="station_id" name="station_id" class="form-select @error('station_id') is-invalid @enderror">
                <option value="">Выберите станцию…</option>
                @foreach($stations as $id => $name)
                    <option value="{{ $id }}" {{ old('station_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @error('station_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Категория объектов --}}
        <div class="mb-3">
            <label for="object_category_id" class="form-label">Категория</label>
            <select id="object_category_id" name="object_category_id" class="form-select @error('object_category_id') is-invalid @enderror">
                <option value="">Выберите категорию…</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ old('object_category_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('object_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Дата отчёта --}}
        <div class="mb-3">
            <label for="report_date" class="form-label">Дата отчёта</label>
            <input type="date" id="report_date" name="report_date"
                   value="{{ old('report_date', now()->toDateString()) }}"
                   class="form-control @error('report_date') is-invalid @enderror">
            @error('report_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- План / Факт --}}
        <div class="mb-3">
            <label for="plan_value" class="form-label">План</label>
            <input type="number" id="plan_value" name="plan_value" min="0"
                   value="{{ old('plan_value', 0) }}"
                   class="form-control @error('plan_value') is-invalid @enderror">
            @error('plan_value') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="fact_value" class="form-label">Факт</label>
            <input type="number" id="fact_value" name="fact_value" min="0"
                   value="{{ old('fact_value', 0) }}"
                   class="form-control @error('fact_value') is-invalid @enderror">
            @error('fact_value') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@endsection
