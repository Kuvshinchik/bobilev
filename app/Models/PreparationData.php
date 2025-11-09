<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreparationData extends Model
{
    protected $fillable = [
        'station_id', 'object_category_id', 'report_date',
        'plan_value', 'fact_value'
    ];
    
    protected $casts = [
        'report_date' => 'date',
        'plan_value' => 'integer',
        'fact_value' => 'integer'
    ];
    
    public function station()
    {
        return $this->belongsTo(Station::class);
    }
    
    public function objectCategory()
    {
        return $this->belongsTo(ObjectCategory::class);
    }
    
    public function getCompletionPercentageAttribute()
    {
        if ($this->plan_value == 0) return 0;
        return ($this->fact_value / $this->plan_value) * 100;
    }
}
