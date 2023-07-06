<?php

namespace Ranium\FlagsDropdown\Commands;

use Illuminate\Console\Command;

class FlagsDropdownCommand extends Command
{
    public $signature = 'filament-flags-dropdown';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
