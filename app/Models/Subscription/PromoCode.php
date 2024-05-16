<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $keyType = 'string';

    protected $guarded = [];

    protected $casts = [
    ];
}
