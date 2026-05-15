<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'client_name',
        'service_type',
        'details',
        'status',
        'application_date',
        'completed_date',
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'application_date' => 'date',
            'completed_date' => 'date',
            'amount' => 'decimal:2',
        ];
    }
}
