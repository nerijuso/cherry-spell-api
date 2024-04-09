<?php

namespace App\Models\Quiz;

use App\Models\Trait\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory, HasMedia;

    public $guarded = [];

    public $casts = [
        'is_active' => 'boolean',
    ];

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }
}
