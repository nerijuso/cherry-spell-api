<?php

namespace App\Http\Resources\API\v1;

use App\Services\Funnel\FunnelPageService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FunnelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $pages = $this->funnelPages()->where('is_active', true)->orderBy('position')->get();
        app(FunnelPageService::class)->preloadFunnelPageData($pages, ['funnelQuestion.options', 'subscriptionPlans']);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'configuration' => $this->configuration,
            'pages' => FunnelPageResource::collection($pages),
        ];
    }

    public static $wrap = '';
}
