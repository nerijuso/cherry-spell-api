<?php

namespace App\Models\FunnelQuiz;

use App\Models\Trait\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelQuizQuestionOption extends Model
{
    use HasFactory, HasMedia;

    protected $guarded = [];
}
