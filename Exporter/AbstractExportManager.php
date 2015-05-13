<?php

namespace Nuxia\Component\FileUtils\Exporter;

use Behat\Transliterator\Transliterator;
use Nuxia\Component\FileUtils\File\FileInterface;

abstract class AbstractExportManager implements ExportManagerInterface
{
    /**
     * @param  FileInterface $file
     * @param  mixed         $data
     * @param  bool          $unAccent
     *
     * @return StreamedFileResponse
     *
     * @throws \RuntimeException
     */
    protected function createResponse(FileInterface $file, $data, $unAccent = true)
    {
        if (null === $file->getFilename()) {
            throw new \RuntimeException('Filename must be set');
        }

        $response = new StreamedFileResponse(Transliterator::urlize($file->getFilename()) . $this->getFileExtension());

        if (true === $unAccent) {
            foreach ($data as $rowIndex => $row) {
                foreach ($row as $dataIndex => $dataValue) {
                    $data[$rowIndex][$dataIndex] = Transliterator::unaccent($dataValue);

                }
            }
        }

        return $response->writeContent($file, $data);
    }
}
