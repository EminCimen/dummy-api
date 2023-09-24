# This is my package dummyapi

[![Latest Version on Packagist](https://img.shields.io/packagist/v/emincimen/dummyapi.svg?style=flat-square)](https://packagist.org/packages/emincimen/dummyapi)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/emincimen/dummyapi/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/emincimen/dummyapi/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/emincimen/dummyapi/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/emincimen/dummyapi/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/emincimen/dummyapi.svg?style=flat-square)](https://packagist.org/packages/emincimen/dummyapi)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/dummyapi.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/dummyapi)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require emincimen/dummy-api
```

## Usage

```php
use EminCimen\DummyApi\Facades\DummyApi;

echo DummyApi::getPaginatedUserList(2);
echo DummyApi::getSingleUser(2);
echo DummyApi::createUser([
    'name' => 'Emin Cimen',
    'job' => 'Software Developer'
]);
```

## Testing

```bash
composer test
```

## Credits

- [EminCimen](https://github.com/EminCimen)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
