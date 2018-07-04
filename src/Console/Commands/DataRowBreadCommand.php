<?php

namespace Codelabs\VoyagerBreadBuilder\Console\Commands;

use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class DataRowBreadCommand extends BaseBreadCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bread:datarows';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new DataRow seed class';

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
        return $this->className = studly_case($this->getNameInput()).'VoyagerDataRowsSeeder';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/data-rows.stub';
    }

    /**
     * Get the single row stub file for the generator.
     *
     * @return string
     */
    protected function getSingleRowStub()
    {
        return __DIR__.'/../../stubs/data-rows-single.stub';
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
     * @throws FileNotFoundException
     */
    protected function replaceAttributes($stub, DataType $dataType): string
    {
        $dataRowsOutput = null;
        foreach (DataRow::where('data_type_id', $dataType->id)->get() as $dataRow) {
            $dataRowsOutput .= $this->getDataRows($dataRow);
        }

        return str_replace(
            [
                '{{class}}',
                '{{name}}',
                '{{field}}',
                '{{data_rows}}',
            ], [
            $this->getClassName(),
            $this->getNameInput(),
            $this->nullify($dataRow->field),
            $dataRowsOutput,
        ],
            $stub
        );
    }

    /**
     * Get the single data row stubs.
     *
     * @param DataRow $dataRow
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    private function getDataRows(DataRow $dataRow)
    {
        $singleRowStub = $this->files->get($this->getSingleRowStub());

        return str_replace(
            [
                '{{field}}',
                '{{type}}',
                '{{display_name}}',
                '{{required}}',
                '{{browse}}',
                '{{read}}',
                '{{edit}}',
                '{{add}}',
                '{{delete}}',
                '{{details}}',
                '{{order}}',
            ], [
                $this->nullify($dataRow->field),
                $this->nullify($dataRow->type),
                $this->nullify($dataRow->display_name),
                $this->nullify($dataRow->required),
                $this->nullify($dataRow->browse),
                $this->nullify($dataRow->read),
                $this->nullify($dataRow->edit),
                $this->nullify($dataRow->add),
                $this->nullify($dataRow->delete),
                $this->nullify($dataRow->details),
                $this->nullify($dataRow->order),
        ],
            $singleRowStub
        );
    }
}
