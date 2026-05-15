<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;

    protected $table = 'about_page';

    protected $fillable = [
        'hero_title',
        'hero_description',
        'story_title',
        'story_description',
        'value1_title',
        'value1_description',
        'value2_title',
        'value2_description',
        'value3_title',
        'value3_description',
        'value4_title',
        'value4_description',
        'value5_title',
        'value5_description',
        'value6_title',
        'value6_description',
        'projects_count',
        'clients_count',
        'years_count',
        'team_count',
    ];

    protected function casts(): array
    {
        return [
            'projects_count' => 'integer',
            'clients_count' => 'integer',
            'years_count' => 'integer',
            'team_count' => 'integer',
        ];
    }
}
