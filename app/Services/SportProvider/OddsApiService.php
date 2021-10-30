<?php

declare(strict_types=1);

namespace App\Services\SportProvider;

use App\Domain\Dto\Value\SportProvider\OddsApiResponseDto;
use Illuminate\Support\Facades\Http;

final class OddsApiService implements ISportProvider
{
    private string $apiKey;
    private string $apiUrl;

    public function __construct()
    {
        $this->apikey =  config('config.sport-providers.odds-api.key');
        $this->apiUrl = config('config.sport-providers.odds-api.url');
    }

    public function fetchSports(object $payload): ?OddsApiResponseDto
    {
        try {
            $payload->queryParams = $payload->queryParams ? '&' . $payload->queryParams : "";
            $url = $this->apiUrl . 'sports/?apiKey=' . $this->apiKey;
            $url .= $payload->queryParams;

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
}
