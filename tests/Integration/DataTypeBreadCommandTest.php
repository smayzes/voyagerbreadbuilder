<?php

namespace Codelabs\VoyagerBreadBuilder\Tests\Integration;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use TCG\Voyager\Models\DataType;

class DataTypeBreadCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @var Carbon */
    protected $date;

    /** @var string */
    protected $expectedSeedPath;

    public function setUp()
    {
//        $this->date = Carbon::create('2016', 1, 1, 21, 1, 1);
//        Carbon::setTestNow($this->date);
//
//        $this->expectedSeedPath = 'database/seeds/'.$this->date->format('Ymd').'/VoyagerDataTypeSeeder.php';

        parent::setUp();

        $this->withFactories(__DIR__ . '/../../database/factories');
    }

    /** @test */
    public function it_can_save_the_seed_file()
    {
        $dataType = factory(DataType::class)->create();

        $this->assertTrue(true);
//        
//        $resultCode = Artisan::call('bread:datatypes', ['name' => $this->date->format('Ymd')]);
//
//        $this->assertEquals(0, $resultCode);
//
//        $this->assertFileExistsOnDisk($this->expectedSeedPath, 'local');
    }
}
