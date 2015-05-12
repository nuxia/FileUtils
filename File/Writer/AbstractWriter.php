<?php

namespace Nuxia\Component\FileUtils\File\Writer;

use Nuxia\Component\FileUtils\File\FileInterface;
use Nuxia\Component\FileUtils\File\FileWriterInterface;

abstract class AbstractWriter implements WriterInterface
{
    protected $file;
    protected $content = array();

    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setContent(array $content)
    {
        $this->content = $content;
    }

    public function count()
    {
        return count($this->content);
    }
}
