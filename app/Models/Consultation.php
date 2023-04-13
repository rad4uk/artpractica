<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'text',
        'status',
    ];

    public array $statuses = [
        0 => 'В ожидании',
        1 => 'Обработан'
    ];

}
