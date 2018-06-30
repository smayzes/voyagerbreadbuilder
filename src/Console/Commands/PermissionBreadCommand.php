<?php

namespace Codelabs\VoyagerBreadBuilder\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class PermissionBreadCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bread:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Permissions seed class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seed';

    /**
     * Get the class name from name input.
     *
     * @return string
     */
    protected function getClassName(): string
    {
        return 'VoyagerPermissionSeeder';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/permission.stub';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     *
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name = null): string
    {
        $stub = $this->files->get($this->getStub());

        return str_replace('{{name}}', $this->getNameInput(), $stub);
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
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path().config('voyagerbreadbuilder.paths.seeds').str_replace('\\', '/', $name).'/'.$this->getClassName().'.php';
    }
}
