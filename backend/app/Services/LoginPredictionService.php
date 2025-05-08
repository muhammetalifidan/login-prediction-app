<?php

namespace App\Services;

use App\Models\Results\DataResult;
use App\Services\Contracts\LoginPredictionServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Carbon\Carbon;

class LoginPredictionService implements LoginPredictionServiceInterface
{
    public function __construct(
        private UserServiceInterface $userService,
    ) {
    }

    public function getAllPredictions(): DataResult
    {
        $usersResult = $this->userService->getAll();

        if (!$usersResult->success) {
            return $usersResult;
        }

        $results = [];

        foreach ($usersResult->data as $user) {
            $logins = json_decode($user['logins'], true);

            $results[] = [
                'id' => $user['external_id'],
                'name' => $user['name'],
                'last_login' => end($logins),
                'predictions' => [
                    'average_interval_prediction' => optional($this->averageInterval($logins))->toIso8601String(),
                    'weekday_pattern_prediction' => optional($this->weekdayPattern($logins))->toIso8601String(),
                    'median_interval_prediction' => optional($this->medianInterval($logins))->toIso8601String(),
                    'hour_based_pattern_prediction' => optional($this->hourBasedPattern($logins))->toIso8601String(),
                ],
            ];
        }

        return new DataResult(true, 200, 'Login predictions fetched', $results);
    }

    /**
     * Ortalama aralık tahmini.
     *
     * Kullanıcının tüm giriş tarihleri arasındaki sürelerin ortalamasını alır.
     * Bu ortalamayı son giriş tarihine ekleyerek bir sonraki tahmini zamanı hesaplar.
     * Aykırı değerlerden etkilenebilir ancak basit ve hızlı bir yaklaşımdır.
     */
    private function averageInterval(array $logins): ?Carbon
    {
        if (count($logins) < 2)
            return null;

        $dates = collect($logins)->map(fn($d) => Carbon::parse($d))->sort();
        $totalSeconds = 0;

        for ($i = 1; $i < $dates->count(); $i++) {
            $totalSeconds += $dates[$i]->diffInSeconds($dates[$i - 1]);
        }

        $avg = $totalSeconds / ($dates->count() - 1);
        return $dates->last()->copy()->addSeconds($avg);
    }

    /**
     * Haftalık tekrar paterni tahmini.
     *
     * Kullanıcının en sık giriş yaptığı haftanın günü belirlenir (örneğin en çok Pazartesi).
     * Son giriş tarihine en yakın aynı gün hesaplanarak bir sonraki giriş zamanı tahmin edilir.
     * Kullanıcının haftalık bir rutini varsa etkili bir tahmin sunar.
     */
    private function weekdayPattern(array $logins): ?Carbon
    {
        if (empty($logins))
            return null;

        $dates = collect($logins)->map(fn($d) => Carbon::parse($d));
        $days = $dates->map(fn($d) => $d->dayOfWeek);
        $mostFrequentDay = $days->countBy()->sortDesc()->keys()->first();

        return $dates->sort()->last()->copy()->next($mostFrequentDay);
    }

    /**
     * Medyan aralık tahmini.
     *
     * Giriş tarihleri arasındaki aralıkların medyanı hesaplanır.
     * Bu medyan değer son giriş tarihine eklenerek tahmin yapılır.
     * Aykırı (çok kısa ya da uzun) giriş aralıklarının etkisini azaltır.
     */
    private function medianInterval(array $logins): ?Carbon
    {
        if (count($logins) < 2)
            return null;

        $dates = collect($logins)->map(fn($d) => Carbon::parse($d))->sort()->values();
        $intervals = [];

        for ($i = 1; $i < $dates->count(); $i++) {
            $intervals[] = $dates[$i]->diffInSeconds($dates[$i - 1]);
        }

        sort($intervals);
        $count = count($intervals);
        $median = ($count % 2 == 0)
            ? ($intervals[$count / 2 - 1] + $intervals[$count / 2]) / 2
            : $intervals[floor($count / 2)];

        return $dates->last()->copy()->addSeconds($median);
    }

    /**
     * En sık saat paterni tahmini.
     *
     * Kullanıcının en çok giriş yaptığı saat belirlenir (örneğin sabah 9).
     * Son giriş tarihine bir gün eklenir ve bu sık görülen saat ayarlanarak tahmin yapılır.
     * Günlük aynı saatte giriş yapan kullanıcılar için uygundur.
     */
    private function hourBasedPattern(array $logins): ?Carbon
    {
        if (empty($logins))
            return null;

        $dates = collect($logins)->map(fn($d) => Carbon::parse($d));
        $hours = $dates->map(fn($d) => $d->hour);
        $mostFrequentHour = $hours->countBy()->sortDesc()->keys()->first();

        $last = $dates->sort()->last();
        return $last->copy()->addDay()->setTime($mostFrequentHour, 0);
    }
}
