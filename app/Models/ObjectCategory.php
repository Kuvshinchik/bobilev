<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectCategory extends Model
{
    protected $fillable = ['name', 'parent_id', 'unit', 'sort_order'];
    
    public function parent()
    {
        return $this->belongsTo(ObjectCategory::class, 'parent_id');
    }
    
    public function children()
    {
        return $this->hasMany(ObjectCategory::class, 'parent_id');
    }
    
    public function preparationData()
    {
        return $this->hasMany(PreparationData::class);
    }
}
