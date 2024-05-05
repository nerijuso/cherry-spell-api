<?php

namespace App\Actions\User;


use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class UploadPhoto
{
    public function __invoke($user, $request): User
    {
        $file = $request->file('photo');
        $images = $user->photo;

        if ($file && $file->isValid()) {
            $allVariantions = collect(config('media.types.user.variations'))->pluck('name')->all();
            array_push($allVariantions, 'original');

            foreach ($allVariantions as $size) {
                if (isset($images[$size]) && $images[$size] !== '') {
                    Storage::delete($images[$size]);
                }
            }

            $path = 'user/images/' . $user->id;
            $fileNameSave = Str::random(10) . '.' . $file->extension();
            $image = $file->storePubliclyAs($path, 'original_' . $fileNameSave);
            data_set($images, 'original', $image);
            $manager = new ImageManager(new Driver());

            foreach (config('media.types.user.variations') as $size) {
                $img = $manager->read(Storage::get($image));
                if ($img->width() > $img->height()) {
                    $img->scale(null, $size['dimensions']['height']);
                    $img->coverDown($size['dimensions']['width'], $size['dimensions']['height']);
                } else {
                    $img->scale($size['dimensions']['width']);
                    $img->coverDown($size['dimensions']['width'], $size['dimensions']['height']);
                }

                $imageResized = $path . '/' . $size['name'] . '_' . $fileNameSave;
                Storage::put($imageResized, $img->encode(), 'public');
                data_set($images, $size['name'], $imageResized);
            }

            $user->photo = $images;
        }


        $user->save();

        return $user;
    }
}
