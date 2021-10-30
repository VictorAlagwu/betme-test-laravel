<?php

namespace App\Http\Controllers\API\V1;

use App\Domain\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponse::responseSuccess([], 'Welcome to BetMe');
    }
}
