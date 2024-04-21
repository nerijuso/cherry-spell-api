<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ReportService extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \App\Services\Report\ReportService::class;
    }
}
