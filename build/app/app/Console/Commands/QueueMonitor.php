<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

class QueueMonitor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:queueMonitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify queue size onto Slack';

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
    {
        if (Queue::size('default') or Queue::size('verify')) {
            Log::stack(['single', 'slack-info'])->info('Queue size', [
                'default' => Queue::size('default'),
                'verify' => Queue::size('verify'),
            ]);
        } else {
            Log::stack(['single'])->info('Queue size', [
                'default' => Queue::size('default'),
                'verify' => Queue::size('verify'),
            ]);
        }
    }
}
