<?php

namespace App\Services\Funnel\PageTypes;

use App\Services\Funnel\FunnelPageType;

class FunnelPageLoader extends FunnelPageType
{
    public function getName(): string
    {
        return 'Page loader simulator';
    }

    public function getResource($funnelPage): array
    {
        return [
        ];
    }
}
