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
        $lead->code = Uuid::uuid7();
        $lead->quiz_id = $funnel->quiz_id;
        $lead->funnel_id = $funnel->id;
        $lead->quiz_answers = $request->all();//handle quiz answers.
        $lead->save();

        return $lead;
    }
}
