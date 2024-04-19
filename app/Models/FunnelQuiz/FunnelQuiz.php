<?php

namespace App\Models\FunnelQuiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelQuiz extends Model
{
    use HasFactory;

    public $guarded = [];

    public $casts = [
        'is_active' => 'boolean',
    ];

    public function funnelQuizQuestion()
    {
        return $this->hasMany(FunnelQuizQuestion::class);
    }
}
