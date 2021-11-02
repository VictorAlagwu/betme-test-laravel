<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Dto\Value\SportProvider\SportProviderResponseDto;
use App\Models\Sport;
use App\Repositories\Sport\ISportRepository;
use App\Services\SportProvider\OddsApiService;
use Illuminate\Database\Eloquent\Collection;

final class SportService
{
    private ISportRepository $sportRepository;
    private OddsApiService $oddsApiService;


    public function __construct(
        ISportRepository $sportRepository,
        OddsApiService $oddsApiService
    ) {
        $this->sportRepository = $sportRepository;
        $this->oddsApiService = $oddsApiService;
    }

    public function index(): Collection
    {
        return $this->sportRepository->with("sportProvider")->all();
    }

    public function findOne(?string $uniqueId, ?string $queryType = "upcoming", bool $clearCache = false): ?SportProviderResponseDto
    {
        if ($uniqueId) {
            $sport = $this->sportRepository->find($uniqueId);
        }
        if ($queryType === "upcoming") {
            $response = $this->fetchInPlayMatches($clearCache);
        } else {
            $response = $this->fetchNotInPlayMatches($sport);
        }
        return $response;
    }

    private function fetchInPlayMatches(bool $clearCache)
    {
        return $this->oddsApiService->fetchInPlayMatches($clearCache);
    }

    private function fetchNotInPlayMatches(Sport $sport)
    {
        return $this->oddsApiService->fetchNotInPlayMatches($sport);
    }
}
