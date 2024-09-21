# Laravel package for accessing the Pixabay API effortlessly.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/joukhar/laravel-pixabay.svg?style=flat-square)](https://packagist.org/packages/joukhar/laravel-pixabay)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/joukhar/laravel-pixabay/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/joukhar/laravel-pixabay/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/joukhar/laravel-pixabay/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/joukhar/laravel-pixabay/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/joukhar/laravel-pixabay.svg?style=flat-square)](https://packagist.org/packages/joukhar/laravel-pixabay)

## Overview

LaravelPixabay is a Laravel package that simplifies the process of interacting with the Pixabay API. It provides a way to search and retrieve images and videos from the Pixabay platform with minimal effort. This package includes various customizable options like image/video type, categories, order, page results, and more.

## Requirements

- PHP 8.0 or higher
- Laravel 9.x or higher
- Pixabay API key (you can get this from [Pixabay's Developer page](https://pixabay.com/api/docs/))

## Support us
If you find my packages useful, consider buying me a coffee to support further development.

<a href="https://www.buymeacoffee.com/joukhar" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" title="Buy Me A Coffee" height="60" width="217"></a>

## Installation

You can install the package via composer:

```bash
composer require joukhar/laravel-pixabay
```

You can publish the config file or add pixabay service to (config/services.php) file:

```bash
php artisan vendor:publish --tag="laravel-pixabay-config"
```

Configuration file (config/pixabay.php): 

```php
return [
    'key' => env('PIXABAY_API_KEY'),
];
```

Then add your Pixabay API key to the .env file:

```env
PIXABAY_KEY=your_pixabay_api_key
```

## Usage

#### get images

```php
$laravelPixabay = new Joukhar\LaravelPixabay();
$laravelPixabay->getImages();
```

#### get specific image

```php
$laravelPixabay = new Joukhar\LaravelPixabay();
$laravelPixabay->getImages(id:"< IMAGE ID HERE >");
```

#### get images with specific type ( ```Default : PixabayImageType::ALL``` )

```php
use Joukhar\LaravelPixabay\Enums\PixabayImageType;

$laravelPixabay = new Joukhar\LaravelPixabay();
$laravelPixabay->getImages(type: PixabayImageType::ILLUSTRATION );
```

#### get videos
```php
$laravelPixabay = new Joukhar\LaravelPixabay();
$laravelPixabay->getVideos();
```

#### get videos with specific type ( ```Default : PixabayVideoType::ALL``` )

```php
use Joukhar\LaravelPixabay\Enums\PixabayVideoType;

$laravelPixabay = new Joukhar\LaravelPixabay();
$laravelPixabay->getVideos(type: PixabayVideoType::ANIMATION);
```

#### get specific video
```php
$laravelPixabay = new Joukhar\LaravelPixabay();
$laravelPixabay->getVideos(id:"< VIDEO ID HERE >");
```

### Customizing API Requests

You can customize your queries using several configuration methods provided by the `LaravelPixabay` class.

**Set Current Page**

You can specify which page of results to fetch using `setCurrentPage()`:

```php
$pixabay->setCurrentPage(2);
```
**Set Maximum Results Per Page**

The number of results per page can be adjusted using `setMaxResults()`:

```php
$pixabay->setMaxResults(50);
```
**Enable Safe Search**

To filter out adult content, use `setSafeSearch()`:

```php
$pixabay->setSafeSearch(true);
```
**Only Editor's Choice**

You can request only editor's choice images or videos using `setOnlyEditorChoice()`:

```php
$pixabay->setOnlyEditorChoice(true);
```
**Set Category**

To fetch resources of a specific category, use `setCategory()`:

```php
use Joukhar\LaravelPixabay\Enums\PixabayCategory;

$pixabay->setCategory(PixabayCategory::NATURE);
```
**Set Order**

To order results by popularity, latest, or custom order, use `setOrder()`:

```php
$pixabay->setOrder('latest');
```
**Set Minimum Dimensions**

You can set the minimum width and height for the images/videos to be returned using `setDimentions()`:
```php
$pixabay->setDimentions(800, 600);
```

#### Example: Fetching Nature Photos

```php
use Joukhar\LaravelPixabay\LaravelPixabay;
use Joukhar\LaravelPixabay\Enums\PixabayCategory;
use Joukhar\LaravelPixabay\Enums\PixabayImageType;

$pixabay = new LaravelPixabay();
$photos = $pixabay
    ->setCategory(PixabayCategory::NATURE)
    ->setMaxResults(10)
    ->setSafeSearch(true)
    ->getImages(null, PixabayImageType::PHOTO);
```

## Exception Handling

If there is an issue with the API request (e.g., invalid API key, request failure), the package throws an `Exception` with a detailed error message.


```php
try {
    $images = $pixabay->getImages();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

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

- [joukhar](https://github.com/joukhar)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
