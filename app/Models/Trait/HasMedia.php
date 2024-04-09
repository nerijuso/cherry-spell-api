<?php

namespace App\Models\Trait;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasMedia
{
    public function getPublicMediaUrlAttribute()
    {
        return ($this->media_file_name) ? Storage::url($this->media_url) : null;
    }

    public function getMediaUrlAttribute()
    {
        return $this->file_path.'/'.$this->media_file_name;
    }

    public function getFilePathAttribute()
    {
        return Str::snake(class_basename(self::class));
    }

    public function saveFile($file, $path = null)
    {
        if ($path === null) {
            $path = $this->media_url;
        }

        if ($file != null && $path !== null) {
            $fileName = Str::random(40);

            if ($file instanceof UploadedFile) {
                $name = $file->hashName();
                $this->media_file_name = $fileName.'.'.pathinfo($name, PATHINFO_EXTENSION);

                Storage::putFileAs($this->file_path, $file, $this->media_file_name, ['visibility' => 'public']);
            } else {
                $content = @file_get_contents($file);

                if ($content !== false) {
                    Storage::put($this->media_url, $content, 'public');
                }
            }

            $this->save();
        }
    }

    public function removeFile()
    {
        $fileName = $this->media_file_name;

        if (! is_null($fileName)) {
            Storage::delete($this->media_url);
            $this->media_file_name = null;
            $this->save();
        }
    }
}
