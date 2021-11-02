<?php

namespace App\Console\Commands;

use App\Events\FetchUpcomingGamesOdd;
use App\Services\SportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchUpcomingMatchsOdds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-sports:live-odds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Sports current Odds';

    protected SportService $sportService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SportService $sportService)
    {
        parent::__construct();
        $this->sportService = $sportService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = $this->sportService->findOne(null, "upcoming", true);
        if ($response->status) {
            event(new FetchUpcomingGamesOdd($response->data));
            return Command::SUCCESS;
        }
        return Command::FAILURE;
    }
}
