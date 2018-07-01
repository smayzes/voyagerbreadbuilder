<?php

namespace Codelabs\VoyagerBreadBuilder\Console\Commands;

use Illuminate\Support\Str;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class MenuItemCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bread:menuitems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new MenuItem seed class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seed';

    /** @var $className */
    private $className;

    /**
     * Get the class name from name input.
     *
     * @param $name
     *
     * @return string
     */
    protected function getClassName($name): string
    {
        return $this->className = studly_case($name).'VoyagerMenuItemSeeder';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/menu-items.stub';
    }

    /**
     * Get the single row stub file for the generator.
     *
     * @return string
     */
    protected function getSingleMenuItemtub()
    {
        return __DIR__.'/../../stubs/menu-items-single.stub';
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
        $menu = Menu::where('name', $this->getNameInput())->firstOrFail();

        return $this->replaceAttributes($stub, $menu->id);
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
        $name = str_replace('\\', '/', Str::replaceFirst($this->rootNamespace(), '', $name));

        return base_path().'/database/seeds/'.$this->getClassName($name).'.php';
    }

    /**
     * Replace the MenuItem attributes for the given stub.
     *
     * @param $stub
     * @param $menuId
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    private function replaceAttributes($stub, $menuId)
    {
        $menuItemOutput = null;
        foreach (MenuItem::where('menu_id', $menuId)->get() as $menuItem) {
            $menuItemOutput .= $this->getMenuItemRows($menuItem);
        }

        return str_replace(
            [
                '{{class_name}}',
                '{{menu_item_rows}}',
            ], [
                $this->className,
                $menuItemOutput,
            ],
            $stub
        );
    }

    /**
     * Get the single MenuItem row stubs.
     *
     * @param MenuItem $menuItem
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    private function getMenuItemRows(MenuItem $menuItem)
    {
        $singleRowStub = $this->files->get($this->getSingleMenuItemtub());

        return str_replace(
            [
                '{{name}}',
                '{{title}}',
                '{{url}}',
                '{{target}}',
                '{{icon_class}}',
                '{{color}}',
                '{{parent_id}}',
                '{{order}}',
                '{{route}}',
                '{{parameters}}',
            ], [
                $this->getNameInput(),
                $menuItem->title,
                $this->nullify($menuItem->url),
                $this->nullify($menuItem->target),
                $this->nullify($menuItem->icon_class),
                $this->nullify($menuItem->color),
                $this->nullify($menuItem->parent_id),
                $this->nullify($menuItem->order),
                $this->nullify($menuItem->route),
                $this->nullify($menuItem->parameters),
            ],
            $singleRowStub
        );
    }

    /**
     * Determine if this should be null, string or integer.
     *
     * @param $value
     *
     * @return string
     */
    private function nullify($value)
    {
        if ($value === null) {
            return 'null';
        }

        if (\is_string($value)) {
            return "'".$value."'";
        }

        return $value;
    }
}
