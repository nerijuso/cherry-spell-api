<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIPrompt extends Model
{
    protected $table = 'ai_prompts';

    protected $fillable = ['short_desc', 'value'];

    public $incrementing = false;

    public $keyType = 'string';
}
