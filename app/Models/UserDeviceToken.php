<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDeviceToken extends Model
{
    protected $table = 'user_device_tokens';

    protected $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
