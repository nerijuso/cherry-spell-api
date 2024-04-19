<?php

namespace App\Models\FunnelQuiz;

use App\Models\Trait\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelQuizQuestion extends Model
{
    use HasFactory, HasMedia;

    public $guarded = [];

    public $casts = [
        'is_active' => 'boolean',
    ];

    public function options()
    {
        return $this->hasMany(FunnelQuizQuestionOption::class);
    }
}
