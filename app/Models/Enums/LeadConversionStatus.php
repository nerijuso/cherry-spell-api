<?php

namespace App\Models\Enums;

enum LeadConversionStatus: string
{
    case REGISTERED = 'registered';
    case INIT_CHECKOUT = 'init_checkout';
}
