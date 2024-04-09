<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->has('email')) {
            $query->where('email', 'LIKE', '%'.$request->input('email').'%');
        }

        $items = $query->paginate(30)->appends($request->all());

        return view('admin.pages.lead.index', ['items' => $items]);
    }

    public function view(Lead $lead)
    {
        return view('admin.pages.lead.view', [
            'lead' => $lead,
        ]);
    }
}
