<?php

namespace App\Services\Report;

use App\Models\AggregatedReport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ReportService
{
    const REPORT_QR_CODE_PREVIEW_TRACKING_KEY = 'qr:preview:user_id';

    const REPORT_DAILY_REGISTERED_USERS_LAST_30_DAYS = 'daily_users_registered_last_30_days';

    const REPORT_DAILY_QR_SCANS_LAST_30_DAYS = 'daily_qr_scans_last_30_days';

    const REPORT_DAILY_TOTAL_REGISTERED_USERS = 'daily_users_total_registered_users';

    const REPORT_DAILY_QR_SCANS = 'daily_qr_scans';

    const REPORT_TOTAL_QR_SCANS = 'total_qr_scans';

    public function trackUserQRCodeGeneratedPreviews(int $userId): void
    {
        Redis::HINCRBY(ReportService::REPORT_QR_CODE_PREVIEW_TRACKING_KEY, $userId, 1);
    }

    public function getUserQRCodeGeneratedPreviews(int $userId): void
    {
        Redis::MGET(ReportService::REPORT_QR_CODE_PREVIEW_TRACKING_KEY, $userId);
    }

    public function generateUserQrPreviewsReport(): void
    {
        foreach (Redis::HGETALL(ReportService::REPORT_QR_CODE_PREVIEW_TRACKING_KEY) as $userId => $count) {
            $report = AggregatedReport::firstOrNew([
                'type' => ReportService::REPORT_QR_CODE_PREVIEW_TRACKING_KEY.':'.$userId,
            ]);

            $report->incValueField($count);

            Redis::HDEL(ReportService::REPORT_QR_CODE_PREVIEW_TRACKING_KEY, $userId);
        }
    }

    public function generateDailyRegisteredUsers(): void
    {
        $dateFrom = Carbon::now()->subMonth();
        $dateTo = Carbon::now();

        $modelStats = new ModelReports('App\Models\User');

        $data = $modelStats->getDailyHistogram($dateFrom, $dateTo, 'created_at', null, false);

        $report = new AggregatedReport();
        $report->type = self::REPORT_DAILY_REGISTERED_USERS_LAST_30_DAYS;
        $report->data = $data;
        $report->save();
    }

    public function generateDailyTotalRegisteredUsers(): void
    {
        $modelStats = new ModelReports('App\Models\User');
        $report = new AggregatedReport();
        $report->type = self::REPORT_DAILY_TOTAL_REGISTERED_USERS;
        $report->incValueField($modelStats->getTotalCount());
        $report->save();
    }

    public function generateDailyQRScans($scans = 0, $dateIndex = null): void
    {
        DB::transaction(function () use ($scans, $dateIndex) {
            $report = AggregatedReport::lockForUpdate()->where([
                'type' => self::REPORT_DAILY_QR_SCANS,
            ])->latest()->first();

            if ($report->created_at->format('Ymd') !== $dateIndex) {
                $report = new AggregatedReport();
                $report->type = self::REPORT_DAILY_QR_SCANS;
            }

            $report->incValueField($scans);
            $report->save();
        }, 3);
    }

    public function generateTotalQRScans($scans = 0): void
    {
        DB::transaction(function () use ($scans) {
            $report = AggregatedReport::lockForUpdate()->firstOrNew([
                'type' => self::REPORT_TOTAL_QR_SCANS,
            ]);
            $report->incValueField($scans);
            $report->save();
        }, 3);
    }

    public function generateLastMonthQrScans()
    {
        $data = AggregatedReport::where('type', self::REPORT_DAILY_QR_SCANS)->limit(30)->latest()->get()->flatMap(function ($item) {
            return [$item->created_at->format('Y-m-d') => data_get($item->data, 'value', 0)];
        })->all();

        $report = AggregatedReport::firstOrNew([
            'type' => self::REPORT_DAILY_QR_SCANS_LAST_30_DAYS,
        ]);
        $report->data = $data;
        $report->save();
    }
}
