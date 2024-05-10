<?php

namespace App\Models\Enums;

enum SubscriptionPlanHighlightedOption
{
    case BEST_VALUE;

    public function value(): string
    {
        return match ($this) {
            self::BEST_VALUE => 'best_value',
        };
    }
}
