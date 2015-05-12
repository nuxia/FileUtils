<?php

namespace Nuxia\Component\FileUtils\Exception;

class FileCantWriteException extends FileException
{
    public function __construct($path)
    {
        parent::__construct(sprintf('Unable to write CSV data to file %s', $path));
    }
} 