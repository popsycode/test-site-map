<?php

use SiteMap\GeneratorFactory;
use SiteMap\Generators\JsonGenerator;
use SiteMap\IGenerator;

require 'vendor/autoload.php';

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
    [
        'loc' =>"https://site.ru/about",
        'lastmod' =>"2020-12-07",
        'priority' =>0.1,
        'changefreq' =>"weekly"
    ],
    [
        'loc' =>"https://site.ru/products",
        'lastmod' =>"2020-12-12",
        'priority' =>0.5,
        'changefreq' =>"daily"
    ],
    [
        'loc' =>"https://site.ru/products/ps5",
        'lastmod' =>"2020-12-11",
        'priority' =>0.1,
        'changefreq' =>"weekly"
    ],
    [
        'loc' =>"https://site.ru/products/xbox",
        'lastmod' =>"2020-12-12",
        'priority' =>0.1,
        'changefreq' =>"weekly"
    ],
    [
        'loc' =>"https://site.ru/products/wii",
        'lastmod' =>"2020-12-11",
        'priority' =>0.1,
        'changefreq' =>"weekly"
    ]
];

(new GeneratorFactory())
    ->createGenerator('xml')
    ->setData($data)
    ->setFilePath(__DIR__.'/generated/sitemap.xml')
    ->generate();
