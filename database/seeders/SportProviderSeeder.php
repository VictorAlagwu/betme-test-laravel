<?php

namespace Database\Seeders;

use App\Models\SportProvider;
use Illuminate\Database\Seeder;

class SportProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SportProvider::create(['name' => 'odds-api']);
    }
}
