<?php

namespace App\Actions\Lead;

use App\Models\Funnel;
use App\Models\Lead;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class GenerateFunnelLead
{
    public function __invoke(Funnel $funnel, Request $request): Lead
    {
        $lead = new Lead();
        $lead->email = $request->email;
        $lead->session_id = Uuid::uuid7();
        $lead->funnel_id = $funnel->id;
        $lead->quiz_answers = $request->all();
        $lead->save();

        return $lead;
    }
}
