<?php

namespace Popsy\SiteMap;

interface IGeneratorFactory
{
    public function createGenerator(string $type):IGenerator;
}
