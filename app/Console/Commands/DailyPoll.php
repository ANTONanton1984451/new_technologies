<?php

namespace App\Console\Commands;

use App\Models\Top;
use App\Services\Endpoint\Endpoint;
use Illuminate\Console\Command;

class DailyPoll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'If you will schedule this command it will be poll endpoint every day and store data in db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Endpoint $endpoint
     * @return int
     */
    public function handle(Endpoint $endpoint)
    {
        $rating = $endpoint->getRatingByDay();
        Top::create($rating);
        return 0;
    }
}
