<?php

namespace Codelabs\VoyagerBreadBuilder\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use TCG\Voyager\Models\Permission;

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
     * Get the single row stub file for the generator.
     *
     * @return string
     */
    protected function getSingleRowStub()
    {
        return __DIR__.'/../../stubs/permission-rows-single.stub';
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

        return $this->replaceAttributes($stub, $this->getNameInput());
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

        return base_path().'/database/seeds/'.str_replace('\\', '/', $name).'/'.$this->getClassName().'.php';
    }

    /**
     * Replace the permission attributes for the given stub.
     *
     * @param $stub
     * @param $name
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    private function replaceAttributes($stub, $name)
    {
        $permissionOutput = null;
        foreach (Permission::where('table_name', $name)->get() as $permission) {
            $permissionOutput .= $this->getPermissionRows($permission);
        }

        return str_replace(
            [
                '{{permissions}}',
            ], [
                $permissionOutput,
            ],
            $stub
        );
    }

    /**
     * Get the single permission row stubs.
     *
     * @param $permission
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    private function getPermissionRows($permission)
    {
        $singleRowStub = $this->files->get($this->getSingleRowStub());

        return str_replace(
            [
                '{{key}}',
                '{{table_name}}',
                '{{permission_group_id}}',
            ], [
                $permission->key,
                $permission->table_name,
                $permission->permission_group_id ?? 'null',
            ],
            $singleRowStub
        );
    }
}
