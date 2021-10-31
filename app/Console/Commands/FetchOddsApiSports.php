<?php

namespace App\Console\Commands;

use App\Repositories\Sport\ISportRepository;
use App\Repositories\SportProvider\ISportProviderRepository;
use App\Services\SportProvider\OddsApiService;
use Illuminate\Console\Command;
use stdClass;

class FetchOddsApiSports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-sports:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected OddsApiService $oddsApiService;
    protected ISportRepository $sportRepository;
    protected ISportProviderRepository $sportProviderRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        OddsApiService $oddsApiService,
        ISportRepository $sportRepository,
        ISportProviderRepository $sportProviderRepository
    ) {
        parent::__construct();

        $this->oddsApiService = $oddsApiService;
        $this->sportRepository = $sportRepository;
        $this->sportProviderRepository = $sportProviderRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = $this->oddsApiService->fetchSports();
        if (!$response->status) {
            echo $response->message;
            return Command::FAILURE;
        }

        $provider = $this->sportProviderRepository->where([
            'name' => 'odds-api'
        ])->first();
        foreach ($response->data as $sport) {
            $this->sportRepository->updateOrCreate(
                [
                    "name" => $sport['title'],
                    "provider_id" => $provider->id,
                ],
                [
                    "name" => $sport['title'],
                    "provider_id" => $provider->id,
                    "meta" => json_encode($sport),
                    "active" => (int) $sport['active'] === 1 ? true : false,
                ]
            );
        }

        // print_r($response->data);
        return Command::SUCCESS;
    }
}
