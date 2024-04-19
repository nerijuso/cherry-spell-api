<?php

namespace App\Services\Funnel\PageTypes;

use App\Services\Funnel\FunnelPageType;

class FunnelPagePaymentStatus extends FunnelPageType
{
    public function getName(): string
    {
        return 'Payment status page Error/Success';
    }

    public function getResource($funnelPage): array
    {
        return [
        ];
    }
}
