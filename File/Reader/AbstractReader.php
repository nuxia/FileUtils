<?php

namespace Nuxia\Component\FileUtils\File\Reader;

use Nuxia\Component\FileUtils\File\FileInterface;

abstract class AbstractReader
{
    protected $file;

    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count(file($this->file->getPath()));
    }
}
