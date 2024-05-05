<?php

namespace App\Models\Trait;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasMedia
{
    public function getPublicMediaUrl($field)
    {
        $image = $this->filePathWithName($field);

        return ! is_null($image) ? Storage::url($image) : null;
    }

    public function getFilePathAttribute()
    {
        return Str::snake(class_basename(self::class));
    }

    public function saveFile($file, $path = null, $field = '')
    {
        $mediaFile = $this->media_file;

        if ($file != null) {
            $fileName = Str::random(40);

            if ($file instanceof UploadedFile) {
                $name = $file->hashName();
                $name = $fileName.'.'.pathinfo($name, PATHINFO_EXTENSION);
                data_set($mediaFile, $field, $name);

                Storage::putFileAs($this->file_path, $file, $name, ['visibility' => 'public']);
            } else {
                $content = @file_get_contents($file);

                if ($content !== false) {
                    $pictureFileName = Str::random(20).'.'.\File::extension($file);
                    data_set($mediaFile, $field, $pictureFileName);
                    $this->media_file = $mediaFile;
                    $filePath = $this->filePathWithName($field);

                    Storage::put($filePath, $content, 'public');
                }
            }

            $this->media_file = $mediaFile;
            $this->save();
        }
    }

    public function filePathWithName($field): ?string
    {
        $img = data_get($this->media_file, $field);

        return ! is_null($img) ? $this->file_path.'/'.$img : null;
    }

    public function removeFile($field)
    {
        $mediaFiles = $this->media_file;
        $fileName = $this->filePathWithName($field);

        if (! is_null($fileName)) {
            Storage::delete($fileName);
            data_set($mediaFiles, $field, null);
            $this->media_file = $mediaFiles;
            $this->save();
        }
    }
}
