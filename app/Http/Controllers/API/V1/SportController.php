<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sport\SportsCollection;
use App\Services\SportService;
use Illuminate\Http\JsonResponse;

class SportController extends Controller
{
    protected SportService $sportService;

    public function __construct(SportService $sportService)
    {
        $this->sportService = $sportService;
    }

    public function index(): JsonResponse
    {
        $sports = $this->sportService->index();

        return (new SportsCollection($sports))->additional([
            'status' => 'success',
            'message' => "List of sports",
        ])->response();
    }
}
