<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $table = 'stations';

    protected $fillable = [
        'region_id',
        'name',
        'code',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function preparationData()
    {
        return $this->hasMany(PreparationData::class);
    }
}
