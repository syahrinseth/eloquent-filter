<?php

namespace SyahrinSeth\EloquentFilter\Commands;

use Illuminate\Console\Command;

class EloquentFilterCommand extends Command
{
    public $signature = 'eloquent-filter {command}';

    public $description = 'Generate custom Eloquent Filter class';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
