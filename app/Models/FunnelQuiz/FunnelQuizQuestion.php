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
        'media_file' => 'array',
    ];

    public array $imageSizes = [
        'size_1x',
        'size_2x',
        'size_3x',
        'size_mobile_1x',
        'size_mobile_2x',
        'size_mobile_3x',
    ];

    public function options()
    {
        return $this->hasMany(FunnelQuizQuestionOption::class);
    }
}
