<?php

namespace App\Console\Commands;

use App\Services\RemoteDataService;
use Illuminate\Console\Command;

class SyncRemoteData extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sync-remote-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves People and Planets from Swapi.tech and import them in the database.';

    private RemoteDataService $remoteDataService;

    /**
     * Create a new command instance.
     *
     * @param  RemoteDataService  $remoteDataService
     */
    public function __construct(RemoteDataService $remoteDataService)
    {
        parent::__construct();
        $this->remoteDataService = $remoteDataService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Deleting local data');
        $this->remoteDataService->deleteLocalData();
        $this->comment('Importing remote data');
        $this->remoteDataService->importAllData();
    }


}
