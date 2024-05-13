<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'configuration' => AsCollection::class,
    ];

    protected $attributes = [
        'configuration' => '{}',
    ];

    public function funnelPages()
    {
        return $this->hasMany(FunnelPage::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
