<?php

namespace SiteMap\Generators;



use SiteMap\AbstractGenerator;

class JsonGenerator extends AbstractGenerator
{

    protected function dataToString():string
    {
        return json_encode($this->data);
    }
}
