<?php

namespace SiteMap\Generators;

use SiteMap\AbstractGenerator;

class CsvGenerator extends AbstractGenerator
{

    protected function dataToString(): string
    {
        $csvStr = "loc;lastmod;changefreq;priority\n";
        foreach ($this->data as $item){
            $csvStr .= "{$item['loc']};{$item['lastmod']};{$item['changefreq']};{$item['priority']}\n";
        }
        return $csvStr;
    }

}
