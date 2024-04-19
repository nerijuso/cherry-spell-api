<?php

namespace App\Services\Funnel\PageTypes;

use App\Services\Funnel\FunnelPageType;

class FunnelPageTextWithLogo extends FunnelPageType
{
    public function getName(): string
    {
        return 'Simple page with text and logo';
    }

    public function getResource($funnelPage): array
    {
        return [
        ];
    }
}
