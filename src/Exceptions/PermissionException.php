<?php

namespace SiteMap\Exceptions;

use Throwable;

class PermissionException extends \Exception
{
    public function __construct(string $dirname = "")
    {
        parent::__construct("Directory '{$dirname}' write permission denied.");
    }
}
