<?php

namespace App\Models\Enums;

enum SubscriptionPlanPeriodType: string
{
    case YEARLY = 'yearly';
    case EVERY_SIX_MONTHS = 'every_six_months';
    case EVERY_THREE_MONTHS = 'every_three_months';
    case MONTHLY = 'monthly';
}
