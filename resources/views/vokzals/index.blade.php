@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Вокзалы РЖД по регионам</h1>
    
    @foreach($regions as $region)
        <div class="card mb-3">
            <div class="card-header">
                <h2>{{ $region->name }}</h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($region->stations as $station)
                        <li class="list-group-item">
                            <a href="{{ route('vokzals.show', $station->id) }}">
                                {{ $station->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
