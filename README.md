# Flags dropdown field for Filament forms

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ranium/filament-flags-dropdown.svg?style=flat-square)](https://packagist.org/packages/ranium/filament-flags-dropdown)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ranium/filament-flags-dropdown/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ranium/filament-flags-dropdown/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ranium/filament-flags-dropdown/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ranium/filament-flags-dropdown/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ranium/filament-flags-dropdown.svg?style=flat-square)](https://packagist.org/packages/ranium/filament-flags-dropdown)

A dropdown field with flags and custom labels. The field can be use as a country or language selector in [Filament forms](https://filamentphp.com/docs/2.x/forms/installation).

This package utilizes [flag-icons](https://github.com/lipis/flag-icons) to display the country flags.

## Installation

You can install the package via composer:

```bash
composer require ranium/filament-flags-dropdown
```

You can publish the config file with (optional):

```bash
php artisan vendor:publish --tag="filament-flags-dropdown-config"
```

## Usage

You can now use the FlagsDropdown field in your form builder. You need to provide the options to display in the dropdown.

The options array keys should be the [ISO 3166-1-alpha-2 code](https://www.iso.org/obp/ui/#search/code/) of the country and the value should be an array of `value` and `label` for the option. In the following example, `IND`
 will be saved in the database when `India` is chosen from the dropdown.
```php
use Ranium\FlagsDropdown\Forms\Components\Fields\FlagsDropdown;

public static function form(Form $form): Form
{
    $countries = [
        'in' => ['IND' => 'India'],
        'us' => ['USA' => 'United States'],    
    ];
    
    return $form
        ->schema([
            // ... Other fields
            FlagsDropdown::make('country')
                ->options($countries), // Chain your field modifiers here
            // Other fields
        ]);
}
```

If you want the dropdown to have the same `value` as the `label` then your options can be built like this:

```php
$countries = [
    'in' => ['India'],
    'us' => ['United States']
];
```

In this case the field's value will be "India" when that option is chosen.

Lastly, if you want the [ISO 3166-1-alpha-2 code](https://www.iso.org/obp/ui/#search/code/) itself to be used as the value of the option then your options array can be built like this:

```php
$countries = [
    'in' => 'India',
    'us' => 'United States'
]; 
```
## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Abbas Ali](https://github.com/abbasali)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
