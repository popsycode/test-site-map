<?php

namespace Popsy\SiteMap\Exceptions;

use RuntimeException;

class ClassNotFoundException extends RuntimeException
{
    public function __construct(string $type = "")
    {
        parent::__construct("Not found generator for type '{$type}'.");
    }
}
