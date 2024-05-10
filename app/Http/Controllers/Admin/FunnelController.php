<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\Funnel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FunnelController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
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

    public function create(Funnel $funnel)
    {
        return view('admin.pages.funnel.create', [
            'funnel' => $funnel,
        ]);
    }

    public function edit(Funnel $funnel)
    {
        return view('admin.pages.funnel.tabs.edit', [
            'funnel' => $funnel,
        ]);
    }

    public function storeNew(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:255',
            'configuration' => 'sometimes|nullable|json',
            'is_active' => 'boolean',
        ]);

        $funnel = (new Funnel())->create([
            'name' => $request->name,
            'configuration' => $request->configuration,
            'is_active' => (bool) $request->is_active,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.funnel.messages.funnel_created'));

        return redirect(route('admin.funnels.edit', ['funnel' => $funnel->id]));
    }

    public function update(Funnel $funnel, Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:255',
            'configuration' => 'sometimes|nullable|json',
            'is_active' => 'boolean',
        ]);

        $funnel->update([
            'name' => $request->name,
            'configuration' => $request->configuration,
            'is_active' => (bool) $request->is_active,
        ]);

        $request->session()->flash('alert-success', trans('admin.page.funnel.messages.funnel_updated'));

        return back();
    }

    public function pages(Funnel $funnel)
    {
        return view('admin.pages.funnel.tabs.page', [
            'funnel' => $funnel,
        ]);
    }
}
