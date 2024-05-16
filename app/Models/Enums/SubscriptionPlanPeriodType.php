<?php

namespace App\Models\Enums;

enum SubscriptionPlanPeriodType: string
{
    case YEARLY = 'year';
    case EVERY_SIX_MONTHS = 'semiannual';
    case EVERY_THREE_MONTHS = 'quarter';
    case MONTHLY = 'month';
    case WEEKLY = 'week';
    case ONE_TIME = 'one_time';
}
