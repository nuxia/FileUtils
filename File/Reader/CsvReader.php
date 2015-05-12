<?php

namespace Nuxia\Component\FileUtils\File\Reader;

use Gedmo\Sluggable\Util\Urlizer;
use Nuxia\Component\FileUtils\Exception\FileIteratorMissingException;
use Nuxia\Component\FileUtils\File\CsvFile;
use Nuxia\Component\FileUtils\Iterator\CsvFileIterator;

class CsvReader extends AbstractReader implements CsvReaderInterface
{
    protected $iterator = null;

    public function __construct(CsvFile $file, CsvFileIterator $iterator = null)
    {
        parent::__construct($file);
        $this->iterator = $iterator === null ? $file->getIterator() : $iterator;
    }

    /**
     * @param callable $formatter
     *
     * @throws \Nuxia\Component\FileUtils\Exception\FileIteratorMissingException
     */
    public function setDynamicColumnNames(\Closure $formatter = null)
    {
        if (null === $this->iterator) {
            throw new FileIteratorMissingException($this);
        }

        if (null === $formatter) {
            $formatter = function ($element) {
                return trim(Urlizer::urlize($element, '_'));
            };
        }

        $buffer = array();

        foreach ($this->getIterator()->current() as $element) {
            $buffer[] = $formatter($element);
        }

        $this->setColumnNames($buffer);
    }

    /**
     * @param mixed $columnNames
     */
    public function setColumnNames($columnNames)
    {
        $this->iterator->setColumnNames($columnNames);
    }

    public function getIterator()
    {
        return $this->iterator;
    }
}
