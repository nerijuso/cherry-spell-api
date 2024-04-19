<?php

namespace App\Http\Resources\API\v1;

use App\Services\Funnel\FunnelPageService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FunnelPageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'next_page_id' => $this->next_page_id,
            'configuration' => $this->configuration,
            'data' => app(FunnelPageService::class)->loadResourceData($this),
        ];
    }

    public static $wrap = '';
}
