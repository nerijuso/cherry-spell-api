<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;

class AggregatedReport extends Model
{
    protected $table = 'aggregated_reports';

    protected $casts = [
        'data' => AsCollection::class
    ];

    protected $fillable = [
        'type'
    ];

    public function incValueField($count)
    {
        $value = data_get($this->data, 'value', 0);
        $value += $count;
        $this->data = ['value' => $value];
        $this->save();
    }
}
