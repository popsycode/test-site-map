<?php

namespace SiteMap;

interface IGenerator
{
    public function generate();
    public function setData(array $data): self;
    public function setFilePath(string $file_path): self;

}
