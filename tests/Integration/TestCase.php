<?php

namespace Codelabs\VoyagerBreadBuilder\Tests\Integration;

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as Orchestra;
use Codelabs\VoyagerBreadBuilder\VoyagerBreadBuilderServiceProvider;

abstract class TestCase extends Orchestra
{
    use TestHelper;

    /**
     * Setup before each test.
     *
     * @return void
     */
    public function setUp()
    {
//        parent::setUp();
//
//        if (Config::get('database.default') === 'sqlite'){
//            $db = app()->make('db');
//            $db->connection()->getPdo()->exec("pragma foreign_keys=1");
//        }
    }

    /**
     * Tear down after each test.
     * @return  void
     */
    public function tearDown()
    {
//        $this->removeDir(base_path('packages'));
        parent::tearDown();
    }

    /**
     * Tell Testbench to use this package.
     *
     * @param $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [VoyagerBreadBuilderServiceProvider::class];
    }
}
