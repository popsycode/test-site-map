<?php

namespace Popsy\SiteMap\Generators;



use Popsy\SiteMap\AbstractGenerator;

class JsonGenerator extends AbstractGenerator
{

    protected function dataToString():string
    {
        return json_encode($this->data);
    }
}
