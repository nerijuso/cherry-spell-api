<?php

namespace App\Services\Funnel;

use App\Models\FunnelPage;
use App\Models\FunnelQuiz\FunnelQuizQuestion;
use App\Models\Subscription\SubscriptionPlan;
use App\Services\Funnel\PageTypes\FunnelPageLandingQuestion;
use App\Services\Funnel\PageTypes\FunnelPagePlans;
use App\Services\Funnel\PageTypes\FunnelPageQuestion;
use Illuminate\Support\Str;

class FunnelPageService
{
    public function getPagesTypes(): array
    {
        $types = [];

        foreach (glob(app_path().'/Services/Funnel/PageTypes/*.php') as $path) {
            $name = basename($path, '.php');
            $types[] = new ('App\Services\Funnel\PageTypes\\'.$name);

        }

        return $types;
    }

    public function loadFormData(string $type)
    {
        return (new ('App\Services\Funnel\PageTypes\\'.Str::studly($type)))->getData();
    }

    public function loadResourceData($funnelPage)
    {
        return (new ('App\Services\Funnel\PageTypes\\'.Str::studly($funnelPage->type)))->getResource($funnelPage);
    }

    public function preloadFunnelPageData(
        \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator &$collection,
        array $loadableItems
    ) {
        if (is_null($collection->first())) {
            return;
        }

        foreach ($loadableItems as $loadableItem) {
            $loadableSplit = explode('.', $loadableItem);
            $loadableKey = array_shift($loadableSplit);
            $loadWith = '';
            if (count($loadableSplit) >= 1) {
                $loadWith = implode('.', $loadableSplit);
            }

            $appendableData[$loadableKey] = [
                'selector' => null,
                'items' => collect(),
            ];

            switch ($loadableKey) {
                case 'funnelQuestion':
                    $appendableData[$loadableKey]['selector'] = 'data.question_id';
                    $keys = array_unique(data_get($collection->whereIn('type', [
                        Str::snake(class_basename(FunnelPageLandingQuestion::class)),
                        Str::snake(class_basename(FunnelPageQuestion::class)),
                    ]), '*.data.question_id'));
                    $query = FunnelQuizQuestion::whereIn('id', $keys);
                    break;
                case 'subscriptionPlans':
                    $appendableData[$loadableKey]['selector'] = 'data.subscription_plan_ids';
                    $keys = array_unique(data_get($collection->where('type',
                        Str::snake(class_basename(FunnelPagePlans::class))
                    ), '*.data.subscription_plan_ids.*'));

                    $query = SubscriptionPlan::whereIn('id', $keys);
                    break;

                default:
                    $query = null;
            }

            if ($query) {
                if (! empty($loadWith)) {
                    $query->with($loadWith);
                }

                $appendableData[$loadableKey]['items'] = $query->get();
            }
        }

        $collection->transform(function (FunnelPage $model) use ($appendableData) {
            foreach ($appendableData as $key => $data) {
                $modeIds = data_get($model, $data['selector']);
                if (is_array($modeIds)) {
                    $model->setAttribute($key, $data['items']->whereIn('id', $modeIds));
                } else {
                    $model->setAttribute($key, $data['items']->where('id', data_get($model, $data['selector']))->first());
                }
            }

            return $model;
        });

    }
}
