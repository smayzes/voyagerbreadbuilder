<?php

use Faker\Generator as Faker;
use TCG\Voyager\Models\DataType;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(DataType::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => str_slug($name),
        'display_name_singular' => str_singular($name),
        'display_name_plural' => str_plural($name),
        'icon' => 'voyager-deck',
        'model_name' => null,
        'policy_name' => null,
        'controller' => null,
        'description' => null,
        'generate_permissions' => $faker->boolean,
        'server_side' => $faker->boolean,
    ];
});
