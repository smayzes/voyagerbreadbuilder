<?php

namespace Codelabs\VoyagerBreadBuilder\Console\Commands;

use TCG\Voyager\Models\DataType;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class DataTypeBreadCommand extends BaseBreadCommand
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
        return $this->className = studly_case($this->getNameInput()).'VoyagerDataTypesSeeder';
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
     * Replace the data attributes for the given stub.
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
                $this->nullify($dataType->name),
                $this->nullify($dataType->slug),
                $this->nullify($dataType->display_name_singular),
                $this->nullify($dataType->display_name_plural),
                $this->nullify($dataType->icon),
                $this->nullify($dataType->model_name),
                $this->nullify($dataType->policy_name),
                $this->nullify($dataType->controller),
                $this->nullify($dataType->description),
                $this->nullify($dataType->generate_permissions),
                $this->nullify($dataType->server_side),
                $dataType->details,
            ],
            $stub
        );
    }
}
