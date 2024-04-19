<?php

namespace App\Models;

use App\Casts\Uuid;
use App\Models\FunnelQuiz\FunnelQuiz;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'quiz_answers' => 'array',
        'code' => Uuid::class,
    ];

    public function quiz()
    {
        return $this->belongsTo(FunnelQuiz::class);
    }

    public function funnel()
    {
        return $this->belongsTo(Funnel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
