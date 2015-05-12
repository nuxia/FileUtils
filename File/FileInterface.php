<?php

namespace Nuxia\Component\FileUtils\File;

interface FileInterface extends FileManipulatorInterface
{
    public function getPath();
    public function getFilePointer();
}