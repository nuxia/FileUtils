<?php

namespace Nuxia\Component\FileUtils\File;


interface FileManipulatorInterface
{
    const TOP_TO_BOTTOM_READ_ONLY = 'r';
    const TOP_TO_BOTTOM_READ_WRITE = 'r+';
    const TOP_TO_BOTTOM_READ_ONLY_OR_CREATE = 'w';
    const TOP_TO_BOTTOM_READ_WRITE_OR_CREATE = 'w+';
    const BOTTOM_TO_TOP_READ_ONLY = 'a';
    const BOTTOM_TO_TOP_READ_WRITE = 'a+';
    const BOTTOM_TO_TOP_READ_ONLY_OR_CREATE = 'x';
    const BOTTOM_TO_TOP_READ_WRITE_OR_CREATE = 'x+';

    public function close();

    public function open($mode);

    public function exists();

    public function delete();
} 