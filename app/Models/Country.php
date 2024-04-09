<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
    protected $fillable = ['fifa'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function updateOrCreateRequest($request)
    {
        return DB::transaction(function () use ($request) {
            $this->name = trim($request->input('name'));
            $this->iso_a2 = $request->input('iso_a2');
            $this->iso_a3 = $request->input('iso_a3');
            $this->fifa = $request->input('fifa');
            $this->position = $request->input('position');
            $this->active = (! is_null($request->input('active'))) ? true : false;
            $this->save();

            return $this;
        });

        return $this;
    }

    public static function getSelectArray()
    {
        return self::orderBy('name')->get(['id', 'name'])->pluck('name', 'id');
    }
}
