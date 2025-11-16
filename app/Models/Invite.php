<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'user_id', 'used', 'expires_at'];

    protected $dates = ['expires_at']; // Для Carbon

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}