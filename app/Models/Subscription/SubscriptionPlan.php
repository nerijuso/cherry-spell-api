<?php

namespace App\Models\Subscription;

use App\Models\Enums\SubscriptionPlanHighlightedOption;
use App\Models\Enums\SubscriptionPlanPeriodType;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'configuration' => AsCollection::class,
        'highlighted_option' => SubscriptionPlanHighlightedOption::class,
        'period' => SubscriptionPlanPeriodType::class,
        'is_hidden' => 'boolean',
        'trial_days' => 'integer',
    ];

    protected $attributes = [
        'configuration' => '{}',
    ];

    public function publicRefId(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => str_replace('price_', '', $attributes['ref_id'])
        )->shouldCache();
    }

    public function scopeWherePriceId($query, $price)
    {
        return $query->where('ref_id', 'price_'.$price);
    }
}
