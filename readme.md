# VoyagerBreadBuilder

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
<a href="https://styleci.io/repos/138692785/shield?style=flat"><img src="https://styleci.io/repos/138692785/shield?style=flat" alt="Build Status"></a>


Laravel Voyager BREAD builder for existing data. The intention of this package is to make it easy to make seeders 
for your [BREAD](https://voyager.readme.io/docs/bread).  
 
## Installation

Via Composer

``` bash
$ composer require codelabs/voyagerbreadbuilder
```

## Usage

### Create a DataType seeder

``` bash
$ php artisan bread:datatypes articles 
```

Replace `articles` with the name of the slug in your `data_types` table. This will create the following file:
```bash
/database/seeds/articles/VoyagerDataTypesSeeder.php
``` 

### Create a DataRow seeder

``` bash
$ php artisan bread:datarows articles 
```

Replace `articles` with the name of the slug in your `data_types` table. This will create the following file:
```bash
/database/seeds/articles/VoyagerDataRowSeeder.php
``` 

### Create a Permission seeder

``` bash
$ php artisan bread:permissions articles 
```

Replace `articles` with the name of the table you want to add permissions to. 

This will create the following seeder:
```bash
/database/seeds/articles/VoyagerDataRowSeeder.php
``` 
This seeder will create the following in the `permissions` table
* browse_articles
* read_articles
* edit_articles
* add_articles
* delete_articles

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email shawn@codelabs.ca instead of using the issue tracker.

## Credits

- [Shawn Mayzes][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/codelabs/voyagerbreadbuilder.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/codelabs/voyagerbreadbuilder.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/codelabs/voyagerbreadbuilder/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/codelabs/voyagerbreadbuilder
[link-downloads]: https://packagist.org/packages/codelabs/voyagerbreadbuilder
[link-travis]: https://travis-ci.org/codelabs/voyagerbreadbuilder
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/codelabs
[link-contributors]: ../../contributors]
