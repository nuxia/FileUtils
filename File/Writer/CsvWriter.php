<?php

namespace Nuxia\Component\FileUtils\File\Writer;

use Nuxia\Component\FileUtils\Exception\FileCantWriteException;
use Nuxia\Component\FileUtils\File\CsvFile;
use Nuxia\Component\FileUtils\File\FileManipulatorInterface;

class CsvWriter extends AbstractWriter implements CsvWriterInterface
{
    public function __construct(CsvFile $file)
    {
        parent::__construct($file);
    }

    public function setColumnsNames(array $columnsNames)
    {
        array_unshift($this->content, $columnsNames);
    }

    public function appendContent($content, array $columnsNames = array())
    {
        //@TODO considerer l'ordre d'écriture pour bien remplir le content
        if (!is_resource($this->file->getFilePointer())) {
            parent::setContent($content);
            $this->setColumnsNames($columnsNames);
        } else {
            array_push($this->content, $content);
        }
    }

    /**
     * @param array $content
     *
     * @throws \Exception
     */
    public function write(array $content, array $columnsNames = array(), $append = false)
    {
        if (!is_resource($this->file->getFilePointer())) {
            $mode = $append ?
                FileManipulatorInterface::BOTTOM_TO_TOP_READ_ONLY :
                FileManipulatorInterface::TOP_TO_BOTTOM_READ_ONLY_OR_CREATE
            ;
            $this->file->open($mode);
        }
        if ($content) {
            $response = fputcsv(
                $this->file->getFilePointer(),
                array_values($content),
                $this->file->getFieldDelimiter(),
                $this->file->getFieldEnclosure()
            );

            if (false === $response) {
                throw new FileCantWriteException($this->file->getPath());
            }
        }
    }
}