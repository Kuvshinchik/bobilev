<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
   protected $fillable = ['name', 'full_name'];
    
    public function stations()
    {
        return $this->hasMany(Station::class);
    }
}
