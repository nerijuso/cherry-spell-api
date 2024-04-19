<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'configuration' => 'array',
    ];

    public function funnelPages()
    {
        return $this->hasMany(FunnelPage::class);
    }
}
