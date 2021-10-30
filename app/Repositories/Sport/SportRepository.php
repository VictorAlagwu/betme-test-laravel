<?php

namespace App\Repositories\Sport;

use App\Models\Sport;
use App\Repositories\BaseRepository;

class SportRepository extends BaseRepository implements ISportRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Sport::class;
    }
}
