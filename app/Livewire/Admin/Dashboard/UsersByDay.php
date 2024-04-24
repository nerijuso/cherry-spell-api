<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\AggregatedReport;
use App\Services\Report\ReportService;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;

class UsersByDay extends Component
{
    public function render()
    {
        $data = AggregatedReport::where('type', ReportService::REPORT_DAILY_REGISTERED_USERS_LAST_30_DAYS)->latest()->first()->data
            ->reduce(function ($lineChartModel, $value, $key) {
                return $lineChartModel->addPoint($key, $value, []);
            }, LivewireCharts::lineChartModel()
                ->setAnimated(true)
                ->setSmoothCurve()
                ->setXAxisVisible(true)
                ->setYAxisVisible(true)
            );

        return view('livewire.admin.dashboard.users-by-day')->with([
            'dailyRegisteredUsers' => $data,
        ]);
    }
}
