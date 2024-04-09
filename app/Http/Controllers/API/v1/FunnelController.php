<?php

namespace App\Http\Controllers\API\v1;

use App\Actions\Lead\GenerateFunnelLead;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\API\v1\StoreFunnelQuizRequest;
use App\Http\Resources\API\v1\FunnelQuizDataResource;
use App\Http\Resources\API\v1\FunnelResource;
use App\Models\Funnel;

class FunnelController extends Controller
{
    public function index(Funnel $funnel)
    {
        if ($funnel->is_active === false) {
            abort(404);
        }

        return new FunnelResource($funnel);
    }

    public function storeQuizData(Funnel $funnel, StoreFunnelQuizRequest $request)
    {
        $lead = (new GenerateFunnelLead())($funnel, $request);


        return new FunnelQuizDataResource($lead);
    }
}
