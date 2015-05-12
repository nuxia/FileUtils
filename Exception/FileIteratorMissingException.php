<?php

namespace Nuxia\Component\FileUtils\Exception;

class FileIteratorMissingException extends FileException
{
    public function __construct($class)
    {
        parent::__construct(sprintf('File iterator missing for %s', get_class($class)));
    }
} 