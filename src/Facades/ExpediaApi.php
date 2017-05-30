<?php
namespace Galiasay\Expedia\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ExpediaApi
 * @package Galiasay\Expedia\Facades
 */
class ExpediaApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ExpediaApi';
    }
}
