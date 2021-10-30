<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Sport\ISportRepository;

final class SportService
{
    private ISportRepository $sportRepository;

    public function __construct(
        ISportRepository $sportRepository
    ) {
        $this->sportRepository = $sportRepository;
    }

    public function index()
    {
        return $this->sportRepository->all();
    }

    public function createOrUpdate()
    {
        // return $this->sportRepository->createOrUpdate
    }
}
