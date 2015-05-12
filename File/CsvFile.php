<?php
namespace Nuxia\Component\FileUtils\File;

use Nuxia\Component\FileUtils\Exception\FileNotFoundException;
use Nuxia\Component\FileUtils\File\Reader\CsvReader;
use Nuxia\Component\FileUtils\File\Writer\CsvWriter;

class CsvFile extends AbstractFile
{
    /**
     * @var string
     */
    protected $fieldDelimiter = ";";

    /**
     * @var string
     */
    protected $fieldEnclosure = '"';

    /**
     * @var string
     */
    protected $lineTerminator = '\n';

    /**
     * @return \Traversable
     *
     * @throws \RuntimeException
     */
    public function getIterator()
    {
        if (!$this->exists()) {
            throw new FileNotFoundException($this->pathToFile);
        }
        return $this->iterator;
    }

    /**
     * @return string
     */
    public function getFieldDelimiter()
    {
        return $this->fieldDelimiter;
    }

    /**
     * @param string $fieldDelimiter
     */
    public function setFieldDelimiter($fieldDelimiter)
    {
        $this->fieldDelimiter = $fieldDelimiter;
    }

    /**
     * @return string
     */
    public function getFieldEnclosure()
    {
        return $this->fieldEnclosure;
    }

    /**
     * @param string $fieldEnclosure
     */
    public function setFieldEnclosure($fieldEnclosure)
    {
        $this->fieldEnclosure = $fieldEnclosure;
    }

    /**
     * @return string
     */
    public function getLineTerminator()
    {
        return $this->lineTerminator;
    }

    /**
     * @param string $lineTerminator
     */
    public function setLineTerminator($lineTerminator)
    {
        $this->lineTerminator = $lineTerminator;
    }

    /**
     * @return CsvWriter|Writer\WriterInterface
     */
    public function getWriter()
    {
        if ($this->writer === null) {
            $this->writer = new CsvWriter($this);
        }
        return $this->writer;
    }

    /**
     * @return CsvReader
     */
    public function getReader()
    {
        if ($this->reader === null) {
            $this->reader = new CsvReader($this);
        }
        return $this->reader;
    }
}