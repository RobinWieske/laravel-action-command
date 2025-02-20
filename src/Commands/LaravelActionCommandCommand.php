<?php

namespace RobinWieske\LaravelActionCommand\Commands;

use Illuminate\Console\Command;

class LaravelActionCommandCommand extends Command
{
    public $signature = 'laravel-action-command';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
