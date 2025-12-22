<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    protected $fillable = [
        'name',
        'full_name',
    ];

    public function stations()
    {
        return $this->hasMany(Station::class);
    }
}
