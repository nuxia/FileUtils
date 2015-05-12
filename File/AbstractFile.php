<?php

namespace Nuxia\Component\FileUtils\File;

use Nuxia\Component\FileUtils\Exception\FileNotFoundException;
use Nuxia\Component\FileUtils\File\Writer\WriterInterface;
use Nuxia\Component\FileUtils\Iterator\FileIteratorInterface;
use Nuxia\Component\FileUtils\Reader\ReaderInterface;

abstract class AbstractFile implements FileInterface
{
    /**
     * A full path to file that is being written / reader
     * @var string
     */
    protected $pathToFile;

    /**
     * @var FileIteratorInterface
     */
    protected $iterator = null;

    /**
     * @var resource
     * Stream of current file
     */
    protected $filePointer;
    protected $writer;
    protected $reader;

    public function __construct($pathToFile)
    {
        ini_set('auto_detect_line_endings', true);
        $this->pathToFile = $pathToFile;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->pathToFile;
    }

    /**
     * @param FileIteratorInterface $iterator
     */
    public function setIterator(FileIteratorInterface $iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * @return void
     */
    public function close()
    {
        if (is_resource($this->filePointer)) {
            fclose($this->filePointer);
        }
    }

    /**
     * @param $mode
     *
     * @throws \RuntimeException
     */
    public function open($mode)
    {
        $this->filePointer = fopen($this->pathToFile, $mode);

        if (false === $this->filePointer) {
            throw new FileNotFoundException($this->pathToFile);
        }
    }

    /**
     * @return void
     */
    public function delete()
    {
        $this->close();

        if ($this->exists()) {
            unlink($this->pathToFile);
        }
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->pathToFile);
    }

    /**
    * @return ressource
    */
    public function getFilePointer()
    {
        return $this->filePointer;
    }

    /**
     * @return ReaderInterface
     */
    abstract public function getReader();

    /**
    * @return WriterInterface
    */
    abstract public function getWriter();
}