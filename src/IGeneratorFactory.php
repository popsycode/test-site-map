<?php

namespace SiteMap;

interface IGeneratorFactory
{
    public function createGenerator(string $type):IGenerator;
}
