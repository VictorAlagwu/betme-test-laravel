<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportProvider extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $guarded = [];

    public function sports()
    {
        return $this->hasMany(Sport::class, "provider_id");
    }
}
