<?php

namespace RobinWieske\LaravelActionCommand\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RobinWieske\LaravelActionCommand\LaravelActionCommand
 */
class LaravelActionCommand extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RobinWieske\LaravelActionCommand\LaravelActionCommand::class;
    }
}
