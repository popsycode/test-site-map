<?php

use PHPUnit\Framework\TestCase;
use SiteMap\Exceptions\PermissionException;
use SiteMap\GeneratorFactory;
use SiteMap\Generators\JsonGenerator;
use SiteMap\Generators\XmlGenerator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

class GeneratorsTest extends TestCase
{
        public $data = [
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

    function test_invalid_path_exception(){
        $this->expectException(InvalidArgumentException::class);
        $factory = new GeneratorFactory();
        $factory->createGenerator('json')
            ->setData($this->data)
            ->setFilePath('../generated/sitemap.json')
            ->generate();
    }

    function test_invalid_data_exception(){
        $this->expectException(InvalidArgumentException::class);
        $factory = new GeneratorFactory();
        $dir = __DIR__.'/generated/';
        $file_name = 'sitemap.json';
        $file_path = $dir.$file_name;
        $factory->createGenerator('json')
            ->setData([
                [
                    'loc' =>"https://site.ru/",
                    'lastmod' =>"2020-12-14",
                    //'priority' =>1,
                    'changefreq' =>"hourly",
                    'foo' => "bar"
                ]
            ])
            ->setFilePath($file_path)
            ->generate();
        //unlink($file_path);
        //rmdir($dir);
    }

    function test_valid_json_generate(){
        $factory = new GeneratorFactory();
        $dir = __DIR__.'/generated/';
        $file_name = 'sitemap.json';
        $file_path = $dir.$file_name;
        $factory->createGenerator('json')
            ->setData($this->data)
            ->setFilePath($file_path)
            ->generate();
        json_decode(file_get_contents($file_path));
        $this->assertEquals(json_last_error(), JSON_ERROR_NONE);
        unlink($file_path);
        rmdir($dir);
    }

    function test_valid_csv_generate(){
        $factory = new GeneratorFactory();
        $dir = __DIR__.'/generated/';
        $file_name = 'sitemap.csv';
        $file_path = $dir.$file_name;
        $factory->createGenerator('csv')
            ->setData($this->data)
            ->setFilePath($file_path)
            ->generate();
        $template = <<<TEMPLATE
loc;lastmod;changefreq;priority
https://site.ru/;2020-12-14;hourly;1
TEMPLATE;
        $this->assertStringStartsWith($template, file_get_contents($file_path));
        unlink($file_path);
        rmdir($dir);
    }


    function test_valid_xml_generate(){
        $factory = new GeneratorFactory();
        $dir = __DIR__.'/generated/';
        $file_name = 'sitemap.xml';
        $file_path = $dir.$file_name;
        $factory->createGenerator('xml')
            ->setData($this->data)
            ->setFilePath($file_path)
            ->generate();
        $template = <<<TEMPLATE
<?xml version="1.0" encoding="utf-8"?>
<urlset
TEMPLATE;
        $this->assertStringStartsWith($template, file_get_contents($file_path));
        unlink($file_path);
        rmdir($dir);
    }



}
