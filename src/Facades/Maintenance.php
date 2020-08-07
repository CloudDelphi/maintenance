<?php

namespace MBonaldo\Maintenance\Facades;

use Illuminate\Support\Facades\Facade;

class Maintenance extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'maintenance';
    }
}
