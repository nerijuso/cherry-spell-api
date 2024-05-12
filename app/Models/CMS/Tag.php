<?php

namespace App\Models\CMS;

use App\Models\Trait\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, HasMedia;

    protected $guarded = [];

    protected $casts = [
        'media_file' => 'array',
    ];

    public array $imageSizes = [
        'size_1x',
        'size_2x',
        'size_3x',
    ];

    public function incrementPostCount(): void
    {
        $this->count++;
        $this->save();
    }

    public function decrementPostCount(): void
    {
        if ($this->count > 0) {
            $this->count--;
            $this->save();
        }
    }
}
