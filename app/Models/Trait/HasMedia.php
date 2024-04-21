<?php

namespace App\Models\Trait;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasMedia
{
    public function getPublicMediaUrl1xAttribute()
    {
        return ($this->media_file_name_1x) ? Storage::url($this->media_url_1x) : null;
    }

    public function getPublicMediaUrl2xAttribute()
    {
        return ($this->media_file_name_2x) ? Storage::url($this->media_url_2x) : null;
    }

    public function getPublicMediaUrl3xAttribute()
    {
        return ($this->media_file_name_3x) ? Storage::url($this->media_url_3x) : null;
    }

    public function getMediaUrl1xAttribute()
    {
        return $this->file_path.'/'.$this->media_file_name_1x;
    }

    public function getMediaUrl2xAttribute()
    {
        return $this->file_path.'/'.$this->media_file_name_2x;
    }

    public function getMediaUrl3xAttribute()
    {
        return $this->file_path.'/'.$this->media_file_name_3x;
    }

    public function getFilePathAttribute()
    {
        return Str::snake(class_basename(self::class));
    }

    public function saveFile($file, $path = null, $size = '')
    {
        if ($path === null) {
            $path = $this->{'media_url_'.$size};
        }

        if ($file != null && $path !== null) {
            $fileName = Str::random(40);

            if ($file instanceof UploadedFile) {
                $name = $file->hashName();
                $this->{'media_file_name_'.$size} = $fileName.'.'.pathinfo($name, PATHINFO_EXTENSION);

                Storage::putFileAs($this->file_path, $file, $this->{'media_file_name_'.$size}, ['visibility' => 'public']);
            } else {
                $content = @file_get_contents($file);

                if ($content !== false) {
                    $pictureFileName = Str::random(40);
                    $this->{'media_file_name_'.$size} = $pictureFileName.'.'.pathinfo($file, PATHINFO_EXTENSION);
                    Storage::put($this->{'media_url_'.$size}, $content, 'public');
                }
            }

            $this->save();
        }
    }

    public function removeFile($size)
    {
        $fileName = $this->{'media_file_name_'.$size};

        if (! is_null($fileName)) {
            Storage::delete($this->{'media_url_'.$size});
            $this->{'media_file_name_'.$size} = null;
            $this->save();
        }
    }
}
