<?php

namespace Popsy\SiteMap\Generators;

use Popsy\SiteMap\AbstractGenerator;

class XmlGenerator extends AbstractGenerator
{


    protected function dataToString(): string
    {
        $doc = new \DOMDocument('1.0', 'utf-8');
        $urlset = $doc->createElement('urlset');

        $attr = $doc->createAttribute('xmlns:xsi');
        $attr->value = 'http://www.w3.org/2001/XMLSchema-instance';
        $urlset->appendChild($attr);

        $attr = $doc->createAttribute('xmlns');
        $attr->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $urlset->appendChild($attr);

        $attr = $doc->createAttribute('xsi:schemaLocation');
        $attr->value = 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd';
        $urlset->appendChild($attr);

        $doc->appendChild($urlset);

        foreach ($this->data as $item){
            $url = $doc->createElement('url');
            $url = $urlset->appendChild($url);

            $child = $doc->createElement('loc', $item['loc']);
            $url->appendChild($child);
            $child = $doc->createElement('lastmod', $item['lastmod']);
            $url->appendChild($child);
            $child = $doc->createElement('changefreq', $item['changefreq']);
            $url->appendChild($child);
            $child = $doc->createElement('priority', $item['priority']);
            $url->appendChild($child);
        }

        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        return $doc->saveXML();
    }
}
