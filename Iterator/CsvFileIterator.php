<?php

namespace Nuxia\Component\FileUtils\Iterator;

use Nuxia\Component\FileUtils\File\CsvFile;
use Nuxia\Component\FileUtils\File\FileManipulatorInterface;

class CsvFileIterator extends FileIterator
{
    /**
     * @var array
     */
    protected $names;

    /**
     * @var boolean
     */
    protected $ignoreFirstLine;

    /**
     * @param        $pathToFile
     * @param string $delimiter
     * @param string $fieldEnclosure
     * @param string $escapeChar
     */
    public function __construct(
        $pathToFile, $delimiter = ';', $fieldEnclosure = "\"", $escapeChar = '\\'
    ) {
        parent::__construct($pathToFile, FileManipulatorInterface::TOP_TO_BOTTOM_READ_ONLY);
        $this->setFlags(self::READ_CSV);
        $this->setCsvControl($delimiter, $fieldEnclosure, $escapeChar);
    }

    /**
     * @param array $names
     */
    public function setColumnNames(array $names)
    {
        $this->names = $names;
    }

    /**
     * @return array|null|string
     */
    public function current()
    {
        $row = parent::current();
        if ($this->key() === 0 && $this->ignoreFirstLine === true) {
            $this->next();
        }
        if ($this->names) {
            if (count($row) != count($this->names)) {
                return null;
            } else {
                $row = array_combine($this->names, $row);
            }
        }

        return $row;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        $current = $this->current();

        if ($this->names) {
            return count($current) == count($this->names);
        }

        return parent::valid();
    }

    /**
     * @param CsvFile $csvFile
     *
     * @return CsvFileIterator
     */
    public static function createFromFile(CsvFile $csvFile)
    {
        return new CsvFileIterator($csvFile->getPath(), $csvFile->getFieldDelimiter(), $csvFile->getFieldEnclosure());
    }

    /**
     * @return $this
     */
    public function ignoreFirstLine()
    {
        $this->ignoreFirstLine = true;
        return $this;
    }
}