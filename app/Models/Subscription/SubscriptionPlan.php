<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'description' => 'string',
        'is_popular' => 'boolean',
        'has_trial' => 'boolean',
        'is_hidden' => 'boolean',
        'trial_days' => 'integer',
    ];
}
