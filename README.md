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

This application provides OpenAPI documentation: [openapi.json](openapi.json).
- The endpoint models support locks, trash with force delete, restoring, revisions and more.
- Index endpoints support advanced query filtering.

OpenAPI API Documentation is built with npm using Redocly.
- npm is only needed to generate documentation and is not needed to operate the Playground: CRM Resource API.

See [package.json](package.json) requirements.

Install npm.

```sh
npm install
```

Build the documentation to generate the [openapi.json](openapi.json) configuration.

```sh
npm run docs
```

Documentation
- Preview [openapi.json on the Redocly Editor UI.](https://redocly.github.io/redoc/?url=https://raw.githubusercontent.com/gammamatrix/playground-crm-resource/develop/openapi.json)

## Installation

You can install the package via composer:

```bash
composer require gammamatrix/playground-crm-resource
```

## `artisan about`

Playground provides information in the `artisan about` command.

<!-- <img src="resources/docs/artisan-about-playground-crm-resource.png" alt="screenshot of artisan about command with Playground: CRM Resource."> -->

## Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Playground\Crm\Resource\ServiceProvider" --tag="playground-config"
```

All routes are enabled by default. They may be disabled via enviroment variable or the configuration.

See the contents of the published config file: [config/playground-crm-resource.php](config/playground-crm-resource.php)

You can publish the routes file with:
```bash
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

```sh
composer cloc
```

```
➜  playground-crm-resource git:(develop) ✗ composer cloc
     426 text files.
     416 unique files.
      95 files ignored.

github.com/AlDanial/cloc v 2.06  T=0.13 s (3168.2 files/s, 289323.5 lines/s)
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
JSON                           169              0              0          17210
PHP                            156           1677           2094           7082
YAML                            53              5              0           5133
Blade                           25            152              0           3602
XML                              9              0              7            827
Markdown                         3             55              1            129
INI                              1              3              0             12
-------------------------------------------------------------------------------
SUM:                           416           1892           2102          33995
-------------------------------------------------------------------------------
```

## PHPStan

Tests at level 10 on:
- `config/`
- `lang/`
- `resources/views/`
- `routes/`
- `src/`
- `tests/Feature/`
- `tests/Unit/`

```sh
composer analyse
```

## Coding Standards

```sh
composer format
```

## Testing

Run unit tests:
```sh
composer test
```

Run unit and feature tests:
```sh
composer test-dev
```

Run unit and feature tests in parallel:
```sh
composer test-parallel
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
