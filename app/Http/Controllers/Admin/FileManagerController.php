<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    /**
     * Show the main application panel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'admin.pages.file_manager.index',
            [
                'folders' => Storage::directories(request('folder', '/')),
                'files' => Storage::files(request('folder', '/')),
                'back' => dirname(request('folder', '/')),
            ]
        );
    }

    public function upload(Request $request)
    {
        $request->validate(
            [
                'folder' => 'required',
                'file' => 'required',
            ]
        );

        $path = rtrim($request->input('folder'), '/');
        $name = $request->input('file_name') ? $request->input('file_name').'.'.$request->file(
            'file'
        )->getClientOriginalExtension() : $request->file('file')->getClientOriginalName();
        $fullPath = $path.'/'.$name;

        if (! Storage::exists($fullPath)) {
            Storage::put($fullPath, file_get_contents($request->file('file')), 'public');
        } else {
            return back()->with('alert-error', trans('kernel.messages.file_exist', ['file' => $fullPath]));
        }

        $size = substr($path, strrpos($path, '/') + 1);
        $request->session()->put('file.'.$size, $fullPath);

        return back()->with('alert-success', trans('kernel.messages.successfully_uploaded'));
    }

    public function delete(Request $request)
    {
        $fullPath = $request->input('file');
        Storage::delete($request->input('file'));

        $savedFiles = $request->session()->get('file');

        if ($savedFiles) {
            foreach ($savedFiles as $key => $savedFile) {
                if ($savedFile === $fullPath) {
                    $request->session()->forget('file.'.$key);
                }
            }
        }

        return back()->with('alert-success', trans('kernel.messages.successfully_removed'));
    }
}
