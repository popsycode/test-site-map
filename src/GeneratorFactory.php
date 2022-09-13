<?php

namespace SiteMap;

use SiteMap\Exceptions\ClassNotFoundException;
use SiteMap\Generators\CsvGenerator;
use SiteMap\Generators\JsonGenerator;
use SiteMap\Generators\XmlGenerator;

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
