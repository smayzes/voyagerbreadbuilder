<?php

namespace Codelabs\VoyagerBreadBuilder\Console\Commands;

use Illuminate\Console\GeneratorCommand;

abstract class BaseBreadCommand extends GeneratorCommand
{
    /**
     * Determine if this should be null, string or integer.
     *
     * @param $value
     *
     * @return string
     */
    protected function nullify($value): string
    {
        if ($value === null) {
            return 'null';
        }

        if (\is_string($value)) {
            return "'".$value."'";
        }

        return $value;
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     *
     * @return string
     */
    protected function getPath($name): string
    {
        return base_path().'/database/seeds/'.$this->getClassName().'.php';
    }
}
