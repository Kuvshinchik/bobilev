@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $station->name }}</h1>
    <p>Регион: {{ $station->region->name }}</p>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Объект</th>
                <th>План</th>
                <th>Факт</th>
                <th>% выполнения</th>
            </tr>
        </thead>
        <tbody>
            @foreach($station->preparationData as $data)
                <tr>
                    <td>{{ $data->objectCategory->name }}</td>
                    <td>{{ $data->plan_value }}</td>
                    <td>{{ $data->fact_value }}</td>
                    <td>{{ number_format($data->completion_percentage, 1) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
