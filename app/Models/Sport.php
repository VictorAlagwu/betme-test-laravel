<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $guarded = [];

    public function sportProvider()
    {
        return $this->belongsTo(SportProvider::class, "provider_id");
    }
}
