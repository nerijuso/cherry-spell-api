<?php

namespace App\Services\Funnel\PageTypes;

use App\Services\Funnel\FunnelPageType;

class FunnelPageReview extends FunnelPageType
{
    public function getName(): string
    {
        return 'Review page';
    }

    public function getResource($funnelPage): array
    {
        return [
        ];
    }
}
