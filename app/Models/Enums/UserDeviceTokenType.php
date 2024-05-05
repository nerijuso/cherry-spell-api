<?php

namespace App\Models\Enums;

use Illuminate\Database\Eloquent\Model;

class UserDeviceTokenType extends Model
{
    public const TYPE_IOS = 'ios';

    public const TYPE_ANDROID = 'android';
}
