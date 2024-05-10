<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\AIPrompt;
use Illuminate\Http\Request;

class AIPromptsController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function index(Request $request)
    {
        $query = AIPrompt::query();
        $items = $query->paginate(30)->appends($request->all());

        return view('admin.pages.ai_prompt.index', ['items' => $items]);
    }

    public function edit(AIPrompt $prompt)
    {
        return view('admin.pages.ai_prompt.edit', [
            'prompt' => $prompt,
        ]);
    }

    public function update(Request $request, AIPrompt $prompt)
    {
        $request->validate([
            'short_desc' => 'required|string',
            'value' => 'required|string',
        ]);

        $prompt->update([
            'short_desc' => $request->short_desc,
            'value' => $request->value,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.ai_prompt.messages.prompt_updated'));

        return back();
    }
}
