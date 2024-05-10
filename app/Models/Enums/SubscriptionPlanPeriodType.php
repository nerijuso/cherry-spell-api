<?php

namespace App\Models\Enums;

enum SubscriptionPlanPeriodType
{
    case YEARLY;
    case EVERY_SIX_MONTHS;
    case EVERY_THREE_MONTHS;
    case MONTHLY;

    public function value(): string
    {
        return match ($this) {
            self::YEARLY => 'yearly',
            self::EVERY_SIX_MONTHS => 'every_six_months',
            self::EVERY_THREE_MONTHS => 'every_three_months',
            self::MONTHLY => 'monthly',
        };
    }

    public static function all(): array
    {
        $items = [];
        foreach (self::cases() as $item) {
            $items[] = $item->value();
        }

        return $items;
    }
}
