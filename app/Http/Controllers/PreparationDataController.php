<?php

namespace App\Http\Controllers;

use App\Models\PreparationData;
use App\Models\Station;
use App\Models\ObjectCategory;
use Illuminate\Http\Request;

class PreparationDataController extends Controller
{
    public function create()
    {
        $stations = Station::orderBy('name')->pluck('name','id');
        $categories = ObjectCategory::orderBy('sort_order')->orderBy('name')->pluck('name','id');

        return view('html.form_preparation_data', [
            'stations' => $stations,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'station_id'         => ['required','integer','exists:stations,id'],
            'object_category_id' => ['required','integer','exists:object_categories,id'],
            'report_date'        => ['required','date'],
            'plan_value'         => ['required','integer','min:0'],
            'fact_value'         => ['required','integer','min:0'],
        ]);

        PreparationData::create($data);

        return redirect()
            ->route('preparation-data.create')
            ->with('success', 'Запись сохранена');
    }
}
