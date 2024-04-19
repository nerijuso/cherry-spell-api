<?php

namespace App\Services\Funnel\PageTypes;

use App\Services\Funnel\FunnelPageType;

class FunnelPageSummary extends FunnelPageType
{
    public function getName(): string
    {
        return 'Generate summary by user quiz';
    }

    public function getResource($funnelPage): array
    {
        return [
        ];
    }
}
