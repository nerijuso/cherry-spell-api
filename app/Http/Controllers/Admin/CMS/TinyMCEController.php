<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TinyMCEController extends Controller
{
    public function uploadImage(Request $request)
    {
        $validated = $request->validate(
            [
                'file' => 'required|image',
            ]
        );

        if (! $validated) {
            return response()->json(['error' => 'Invalid file'], 400);
        }

        $path = 'cms';
        $name = $request->file('file')->getClientOriginalName();
        $fullPath = $path.'/'.Str::snake($name);

        if (! Storage::exists($fullPath)) {
            Storage::put($fullPath, file_get_contents($request->file('file')), 'public');
        } else {
            return response()->json(['error' => trans('kernel.messages.file_exist', ['file' => $fullPath])], 400);
        }

        return response()->json(['location' => Storage::url($fullPath)], 200);
    }
}
