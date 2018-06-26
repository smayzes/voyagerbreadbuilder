<?php

namespace Codelabs\VoyagerBreadBuilder\Facades;

use Illuminate\Support\Facades\Facade;

class VoyagerBreadBuilder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'voyagerbreadbuilder';
    }
}
