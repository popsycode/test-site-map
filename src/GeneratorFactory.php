<?php

namespace Popsy\SiteMap;

use Popsy\SiteMap\Exceptions\ClassNotFoundException;
use Popsy\SiteMap\Generators\CsvGenerator;
use Popsy\SiteMap\Generators\JsonGenerator;
use Popsy\SiteMap\Generators\XmlGenerator;

class GeneratorFactory implements IGeneratorFactory
{

    public function createGenerator(string $type): IGenerator
    {
        $classGenerator = match ($type){
            'xml' => XmlGenerator::class,
            'json' => JsonGenerator::class,
            'csv' => CsvGenerator::class,
            default => throw new ClassNotFoundException($type)
        };
        return new $classGenerator();
    }

}
