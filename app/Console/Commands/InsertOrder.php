<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InsertOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert users';

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
     * @return mixed
     */
    public function handle()
    {echo 1;
    }
}
