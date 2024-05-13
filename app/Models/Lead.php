<?php

namespace App\Models;

use App\Models\Enums\LeadConversionStatus;
use App\Models\FunnelQuiz\FunnelQuiz;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'quiz_answers' => 'array',
        'conversion_status' => LeadConversionStatus::class,
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

    public function setToRegistered()
    {
        $this->conversion_status = LeadConversionStatus::REGISTERED;
        $this->save();
    }

    public function setToInitCheckout($save = true)
    {
        $this->conversion_status = LeadConversionStatus::INIT_CHECKOUT;

        if ($save === true) {
            $this->save();
        }

        return $this;
    }
}
