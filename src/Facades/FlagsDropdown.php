<?php

namespace Ranium\FlagsDropdown\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ranium\FlagsDropdown\FlagsDropdown
 */
class FlagsDropdown extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ranium\FlagsDropdown\FlagsDropdown::class;
    }
}
