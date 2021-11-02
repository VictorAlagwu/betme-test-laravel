<?php

declare(strict_types=1);

namespace App\Services\SportProvider;

use App\Domain\Dto\Value\SportProvider\OddsApiResponseDto;
use App\Models\Sport;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

final class OddsApiService implements ISportProvider
{
    // private CacheRepository $cacheRepository;
    private string $apiKey;
    private string $apiUrl;

    public function __construct()
    {
        $this->apiKey =  config('config.sport-providers.odds-api.key');
        $this->apiUrl = config('config.sport-providers.odds-api.url');
    }

    public function fetchSports(?string $queryParams = ""): ?OddsApiResponseDto
    {
        try {
            $url = $this->apiUrl . 'sports/?apiKey=' . $this->apiKey;
            if ($queryParams) {
                $url .= '&' . $queryParams;
            }

            $response = Http::get($url);

            if ($response->failed()) {
                return new OddsApiResponseDto(
                    false,
                    $response->json()['message'] ?? "Unable to fetch sports data",
                    []
                );
            }

            $data = $response->json()['data'];
            if (!$data || !$response->json()['success']) {
                return new OddsApiResponseDto(
                    false,
                    $response->json()['message'] ?? "Unable to fetch sports data",
                    []
                );
            }

            return new OddsApiResponseDto(true, "All Sports fetched successfully", $data);
        } catch (\Throwable $exception) {
            report($exception);
            return new OddsApiResponseDto(
                false,
                $exception->getMessage(),
                []
            );
        }
    }

    public function fetchInPlayMatches(bool $clearCache = false): ?OddsApiResponseDto
    {
        try {
            $redis = Redis::connection();
            $url = $this->apiUrl . 'odds/?apiKey=' . $this->apiKey;
            $url .= '&sport=upcoming&region=uk&mkt=h2h';

            $key = "odds-api-upcoming-sports:uk:h2h";
            //Get from cache First
            $upcomingSports = $redis->get($key);
            if (!empty($upcomingSports) && $clearCache) {
                return new OddsApiResponseDto(
                    true,
                    "All upcoming sports fetched successfully",
                    json_decode($upcomingSports, true)
                );
            }

            $response = Http::get($url);

            if ($response->failed()) {
                return new OddsApiResponseDto(
                    false,
                    $response->json()['message'] ?? "Unable to fetch sports data",
                    []
                );
            }

            $data = $response->json()['data'];
            if (!$data || !$response->json()['success']) {
                return new OddsApiResponseDto(
                    false,
                    $response->json()['message'] ?? "Unable to fetch sports data",
                    []
                );
            }
            $payload = json_encode($data);
            //Add time , now()->addMinutes(5)
            $redis->set($key, $payload);

            return new OddsApiResponseDto(true, "All Sports fetched successfully", $data);
        } catch (\Throwable $exception) {
            report($exception);
            return new OddsApiResponseDto(
                false,
                $exception->getMessage(),
                []
            );
        }
    }

    public function fetchNotInPlayMatches(Sport $sport): ?OddsApiResponseDto
    {
        try {
            $redis = Redis::connection();
            $meta = json_decode($sport->meta, true);
            $key = "odds-api-not-inplay-sports:uk:h2h:" . $meta['key'];
            $url = $this->apiUrl . 'odds/?apiKey=' . $this->apiKey;
            $url .= '&sport=' . $meta['key'] . '&region=uk&mkt=h2h';

            //Get from cache First
            $notInPlaySports = $redis->get($key);
            if (!empty($notInPlaySports)) {
                return new OddsApiResponseDto(
                    true,
                    "All not in play sports fetched successfully",
                    json_decode($notInPlaySports, true)
                );
            }

            $response = Http::get($url);

            if ($response->failed()) {
                return new OddsApiResponseDto(
                    false,
                    $response->json()['message'] ?? "Unable to fetch sports data",
                    []
                );
            }

            $data = $response->json()['data'];
            if (!$data || !$response->json()['success']) {
                return new OddsApiResponseDto(
                    false,
                    $response->json()['message'] ?? "Unable to fetch sports data",
                    []
                );
            }
            // , now()->addMinutes(60) Limit to 1 hour cache storage
            $redis->set($key, json_encode($data));
            return new OddsApiResponseDto(true, "All Sports fetched successfully", $data);
        } catch (\Throwable $exception) {
            report($exception);
            return new OddsApiResponseDto(
                false,
                $exception->getMessage(),
                []
            );
        }
    }
}
