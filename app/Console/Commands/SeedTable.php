<?php

namespace App\Console\Commands;

use App\Models\Top;
use App\Services\Endpoint\Endpoint;
use Illuminate\Console\Command;

class SeedTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserting into table ratings in the last thirty days';

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
        $ratingList = $endpoint->getRatingByMonth();

        Top::insert($ratingList);

        return 0;
    }
}
