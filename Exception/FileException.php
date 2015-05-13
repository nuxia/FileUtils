<?php

namespace Nuxia\Component\FileUtils\Exception;

use Symfony\Component\HttpFoundation\File\Exception\FileException as SymfonyFileException;

/**
 * Base class for FileUtils component exceptions
 *
 * @author Yannick Snobbert <yannick.snobbert@gmail.com>
 */
class FileException extends SymfonyFileException
{

} 