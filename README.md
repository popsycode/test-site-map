## This package generate sitemap in multiple formals (xml, csv, json)

### For Laravel use [Laravel-wrapper](https://github.com/popsycode/laravel-site-map)

## Installation

Require this package in your composer.json and update composer.

    composer require popsy/test-site-map


## Usage

Use this data format:

```php
$data = [
    [
        'loc' =>"https://site.ru/",
        'lastmod' =>"2020-12-14",
        'priority' =>1,
        'changefreq' =>"hourly"
    ],
    [
        'loc' =>"https://site.ru/news",
        'lastmod' =>"2020-12-10",
        'priority' =>0.5,
        'changefreq' =>"daily"
    ],
    // .....
];
```
For example use Factory

```php
use Popsy\SiteMap\GeneratorFactory;

(new GeneratorFactory())
    ->createGenerator('xml')
    ->setData($data)
    ->setFilePath(__DIR__.'/generated/sitemap.xml')
    ->generate();
```

or concrete

```php
use Popsy\SiteMap\Generators\XmlGenerator;

(new XmlGenerator())
    ->setData($data)
    ->setFilePath(__DIR__.'/generated/sitemap.xml')
    ->generate();
```
