<?php

namespace App\Repositories\SportProvider;

use App\Models\SportProvider;
use App\Repositories\BaseRepository;

class SportProviderRepository extends BaseRepository implements ISportProviderRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return SportProvider::class;
    }
}
