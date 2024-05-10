<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelPage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'configuration' => AsCollection::class,
        'data' => 'array',
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        'configuration' => '{}',
    ];
}
