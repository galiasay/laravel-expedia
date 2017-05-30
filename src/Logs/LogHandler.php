<?php

namespace Galiasay\Expedia\Logs;

/**
 * Interface LogHandler
 */
interface LogHandler
{
    /**
     * @return mixed
     */
    public function createHandler();
}