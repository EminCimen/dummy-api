<?php

namespace EminCimen\DummyApi\Commands;

use Illuminate\Console\Command;

class DummyApiCommand extends Command
{
    public $signature = 'dummyapi';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
