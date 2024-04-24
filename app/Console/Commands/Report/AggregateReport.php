<?php

namespace App\Console\Commands\Report;

use App\Facades\ReportService;
use Illuminate\Console\Command;

class AggregateReport extends Command
{
    protected $signature = 'report:aggregate-report';

    protected $description = 'Generate reports';

    public function handle(): void
    {
        ReportService::generateDailyRegisteredUsers();
        ReportService::generateDailyTotalRegisteredUsers();
    }
}
