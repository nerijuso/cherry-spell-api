<?php

namespace App\Services\Funnel\PageTypes;

use App\Services\Funnel\FunnelPageType;

class FunnelPageSubmitQuiz extends FunnelPageType
{
    public function getName(): string
    {
        return 'Submit quiz (save user quiz data)';
    }

    public function getResource($funnelPage): array
    {
        return [
        ];
    }
}
