<?php

namespace Popsy\SiteMap;

use Exception;
use InvalidArgumentException;
use Popsy\SiteMap\Exceptions\PermissionException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

abstract class AbstractGenerator implements IGenerator
{

    protected array $data;
    protected string $file_path;

    private Filesystem $filesystem;

    private array $url_values = ['loc', 'lastmod', 'changefreq', 'priority'];

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    abstract protected function dataToString():string;

    /**
     * @throws Exception
     */
    public function generate()
    {
        if(!isset($this->data))
            throw new InvalidArgumentException('Data is empty.');

        if(!isset($this->file_path))
            throw new InvalidArgumentException('Path should be setted.');

        $info = (object) pathinfo($this->file_path);

        $path = Path::canonicalize($info->dirname);
        if(!$this->filesystem->exists($path))
            $this->filesystem->mkdir($path);
        if(!is_writable($path))
            throw new PermissionException($path);
        file_put_contents($path.'/'.$info->basename, $this->dataToString());
//        dump($info);
//        dump($path);
//        dump($this->filesystem);
//        dump(Path::isAbsolute(pathinfo($this->file_path)['dirname']));
    }


    public function setData(array $data): IGenerator
    {
        $this->data = [];
        foreach ($data as $item){
            if(!is_array($item) || !empty(array_diff($this->url_values, array_keys($item)))){
                throw new InvalidArgumentException('Data has invalid format!');
            }
            $adding = [];
            foreach ($this->url_values as $key)
                $adding[$key] = $item[$key];
            $this->data[] = $adding;
        }
        return $this;
    }

    public function setFilePath(string $file_path): IGenerator
    {
        $this->file_path = $file_path;
        $info = (object) pathinfo($this->file_path);
        if(!Path::isAbsolute($info->dirname))
            throw new InvalidArgumentException('Path should be absolute.');
        return $this;
    }
}
