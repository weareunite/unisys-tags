# unisys-tags
Unisys API module to add tags and taggable behaviour with custom_properties to Unisys app inspired by https://github.com/spatie/laravel-tags


## Requirements

This package requires Laravel 5.6 or higher, PHP 7.1 or higher and a database that supports `json` fields such as MySQL 5.7 or higher.

## Installation

You can install the package via composer:

``` bash
composer require weareunite/unisys-tags
```

The package will automatically register itself.

You can install it with:
```bash
php artisan unisys-api:install:tags
```

## Testing

1. Copy `.env.example` to `.env` and fill in your database credentials.
2. Run `vendor/bin/phpunit`.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.