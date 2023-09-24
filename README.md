## Installation

You can install the package via composer:

```bash
composer require --dev emincimen/dummy-api:dev-main
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
