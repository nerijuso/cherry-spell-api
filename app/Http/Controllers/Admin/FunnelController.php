<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\Funnel;
use App\Models\Quiz\Quiz;
use Illuminate\Http\Request;

class FunnelController extends Controller
{
    /**
     * Display a listing of the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Funnel::query();

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%'.$request->input('name').'%');
        }

        $items = $query->paginate(30)->appends($request->all());

        return view('admin.pages.funnel.index', ['items' => $items]);
    }

    public function create(Funnel $item)
    {
        return view('admin.pages.funnel.create', [
            'item' => $item,
            'quizzes' => Quiz::where('is_published', true)->get(),
        ]);
    }

    public function edit(Funnel $funnel)
    {
        return view('admin.pages.funnel.edit', [
            'item' => $funnel,
            'quizzes' => Quiz::where('is_published', true)->get(),
        ]);
    }

    public function storeNew(Request $request)
    {
        $quizIds = Quiz::where('is_published', true)->get()->pluck('id')->all();
        $request->validate([
            'quiz_id' => 'required|integer|in:'.implode(',', $quizIds),
            'name' => 'required|min:1|max:255',
            'configuration' => 'required|json',
            'is_active' => 'boolean',
        ]);

        $funnel = (new Funnel())->create([
            'quiz_id' => $request->quiz_id,
            'name' => $request->name,
            'configuration' => $request->configuration,
            'is_active' => (bool) $request->is_active,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.funnel.messages.funnel_created'));

        return redirect(route('admin.funnels.edit', ['funnel' => $funnel->id]));
    }

    public function update(Funnel $funnel, Request $request)
    {
        $quizIds = Quiz::where('is_published', true)->get()->pluck('id')->all();

        $request->validate([
            'quiz_id' => 'required|integer|in:'.implode(',', $quizIds),
            'name' => 'required|min:1|max:255',
            'configuration' => 'required|json',
            'is_active' => 'boolean',
        ]);

        $funnel->update([
            'quiz_id' => $request->quiz_id,
            'name' => $request->name,
            'configuration' => $request->configuration,
            'is_active' => (bool) $request->is_active,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.funnel.messages.funnel_updated'));

        return back();
    }
}
