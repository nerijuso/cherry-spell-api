<?php

namespace App\Services\Funnel\PageTypes;

use App\Services\Funnel\FunnelPageType;

class FunnelPagePayment extends FunnelPageType
{
    public function getName(): string
    {
        return 'Payment to payment gateway';
    }

    public function getResource($funnelPage): array
    {
        return [

        ];
    }
}
