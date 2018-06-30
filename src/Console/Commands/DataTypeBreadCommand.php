<?php

namespace Codelabs\VoyagerBreadBuilder\Console\Commands;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use TCG\Voyager\Models\DataType;

class DataTypeBreadCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bread:datatypes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new DataType seed class';

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
        return 'VoyagerDataTypesSeeder';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/data-types.stub';
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
        $dataType = DataType::where('slug', $this->getNameInput())->firstOrFail();

        return $this->replaceAttributes($stub, $dataType);
    }

    /**
     * Replace the data attributes name for the given stub.
     *
     * @param  string $stub
     * @param DataType $dataType
     *
     * @return string
     */
    protected function replaceAttributes($stub, DataType $dataType): string
    {
        return str_replace(
            [
                '{{class}}',
                '{{slug}}',
                '{{name}}',
                '{{display_name_singular}}',
                '{{display_name_plural}}',
                '{{icon}}',
                '{{model_name}}',
                '{{policy_name}}',
                '{{controller}}',
                '{{description}}',
                '{{generate_permissions}}',
                '{{server_side}}',
                '{{details}}',
            ], [
                $this->getClassName(),
                $dataType->name,
                $dataType->slug,
                $dataType->display_name_singular,
                $dataType->display_name_plural,
                $dataType->icon,
                $this->getReflectionClass($dataType->model_name),
                $this->getReflectionClass($dataType->policy_name),
                $this->getReflectionClass($dataType->controller),
                $dataType->description,
                $dataType->generate_permissions,
                $dataType->server_side,
                $dataType->details,
            ],
            $stub
        );
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

    /**
     * Return the class namespace or null
     *
     * @param $model_name
     *
     * @return null|string
     * @throws \ReflectionException
     */
    private function getReflectionClass($model_name): ?string
    {
        if (!empty($model_name)) {
            $class = new \ReflectionClass($model_name);

            return $class->getName().'::class';
        }

        return 'null';
    }
}
