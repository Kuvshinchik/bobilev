<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'tabelNumber',
        'statusSite',
        'statusVokzal',
        'vokzal',
        'rdzv',
        'dzv',
        'vakcina',
    ];

    // Если вы хотите, чтобы `tabelNumber` не конфликтовал с типами (например, очень большое число),
    // убедитесь, что в БД оно `BIGINT` (а Laravel по умолчанию делает bigInteger — это правильно).
}