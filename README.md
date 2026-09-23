# Playground: CRM Resource

[![Playground CI Workflow](https://github.com/gammamatrix/playground-crm-resource/actions/workflows/ci.yml/badge.svg?branch=develop)](https://raw.githubusercontent.com/gammamatrix/playground-crm-resource/testing/develop/testdox.txt)
[![Test Coverage](https://raw.githubusercontent.com/gammamatrix/playground-crm-resource/testing/develop/coverage.svg)](tests)
[![PHPStan Level 10](https://img.shields.io/badge/PHPStan-level%2010-brightgreen)](.github/workflows/ci.yml#L128)

Playground: CRM Resource

This package provides an API and a Blade UI for interacting with the [Playground: CRM](https://github.com/gammamatrix/playground-crm), a model package for Laravel.

If you need a JSON API without a UI, then have a look at [Playground: CRM API.](https://github.com/gammamatrix/playground-crm-api)

## Documentation

Read more on using [Playground: CRM Resource at Read the Docs: Playground Documentation](https://gammamatrix-playground.readthedocs.io/en/develop/built-components/crm.html)

### Postman

A postman collection is provided in the repository: [postman-playground-crm-resource.json.](postman-playground-crm-resource.json)
- This same collection is viewable on the [.]()

### OpenAPI

This application provides OpenAPI documentation: [openapi.yaml](openapi.yaml).
- The endpoint models support locks, trash with force delete, restoring, revisions and more.
- Index endpoints support advanced query filtering.

OpenAPI API Documentation is built with npm using Redocly.
- npm is only needed to generate documentation and is not needed to operate the Playground: CRM Resource API.

See [package.json](package.json) requirements.

Install npm.

```shell
npm install
```

Build the documentation to generate the [openapi.yaml](openapi.yaml) configuration.

```shell
npm run docs
```

Documentation
- Preview [openapi.yaml on the Redocly Editor UI.](https://redocly.github.io/redoc/?url=https://raw.githubusercontent.com/gammamatrix/playground-crm-resource/develop/openapi.yaml)

## Installation

You can install the package via composer:

```shell
composer require gammamatrix/playground-crm-resource
```

## `artisan about`

Playground provides information in the `artisan about` command.

<!-- <img src="resources/docs/artisan-about-playground-crm-resource.png" alt="screenshot of artisan about command with Playground: CRM Resource."> -->

## Configuration

You can publish the config file with:

```shell
php artisan vendor:publish --provider="Playground\Crm\Resource\ServiceProvider" --tag="playground-config"
```

All routes are enabled by default. They may be disabled via environment variable or the configuration.

See the contents of the published config file: [config/playground-crm-resource.php](config/playground-crm-resource.php)

You can publish the routes file with:
```shell
php artisan vendor:publish --provider="Playground\Crm\Resource\ServiceProvider" --tag="playground-routes"
```
- The routes while be published in a folder at `routes/playground-crm-resource`

### Environment Variables

If you are unable or do not want to publish [configuration files for this package](config/playground-crm-resource.php),
you may override the options via system environment variables.

Information on [environment variables is available on the wiki for this package](https://github.com/gammamatrix/playground-crm-resource/wiki/Environment-Variables)

## Migrations

This package requires the migrations in [playground-crm](https://github.com/gammamatrix/playground-crm) a Laravel package.

## Cloc

```shell
composer cloc
```

```terminaloutput
➜  playground-crm-resource git:(develop) ✗ composer cloc
     433 text files.
     422 unique files.                                          
     187 files ignored.

github.com/AlDanial/cloc v 2.08  T=0.16 s (2695.3 files/s, 299648.3 lines/s)
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
JSON                           170              0              0          18857
YAML                            54              4              0          11513
PHP                            157           1684           2110           7388
Blade                           25            152              0           3722
XML                             12              0              7           1268
Markdown                         3             58              1            136
INI                              1              3              0             12
-------------------------------------------------------------------------------
SUM:                           422           1901           2118          42896
-------------------------------------------------------------------------------
```

## PHPStan

Tests at level 10 on:
- `config/`
- `resources/views/`
- `routes/`
- `src/`
- `tests/Feature/`
- `tests/Unit/`

```shell
composer analyse
```

## Coding Standards

Format source code:
```shell
composer format
```

Format blades in resources/views:

```shell
composer format-blade
```
- **NOTE:** requires installing dev packages from package.json.

```shell
npm install
```

## Testing

Run unit tests:
```shell
composer test
```

Run unit and feature tests:
```shell
composer test-dev
```

Run unit and feature tests in parallel:
```shell
composer test-parallel
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
