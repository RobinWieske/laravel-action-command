# This package provides a simple `action:make` command to generate invokable action classes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/robinwieske/laravel-action-command.svg?style=flat-square)](https://packagist.org/packages/robinwieske/laravel-action-command)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/robinwieske/laravel-action-command/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/robinwieske/laravel-action-command/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/robinwieske/laravel-action-command/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/robinwieske/laravel-action-command/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/robinwieske/laravel-action-command.svg?style=flat-square)](https://packagist.org/packages/robinwieske/laravel-action-command)

This package allows you to easily create `Action` classes in your laravel project. You can either just use the 
`php artisan make:model` command and pass the `--actions` flag to create `Create{Model}Action`, `Update{Model}Action` and `Delete{Model}Action` actions or you can directly use `php artisan make:action`.

## Installation

You can install the package via composer:

```bash
composer require robinwieske/laravel-action-command
```

## Usage

Create an action class directly:

```bash
php artisan action:make User/CreateUserAction
```

Or pass the `--actions` flag to your `php artisan make:model` command:

```bash
php artisan make:model Post -mcf --actions
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Robin Wieske](https://github.com/RobinWieske)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
