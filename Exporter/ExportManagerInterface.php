<?php

namespace Nuxia\Component\FileUtils\Exporter;

interface ExportManagerInterface
{
    /**
     * @param array $datas
     * @param string $filename
     *
     * @return StreamedFileResponse
     */
    public function export($datas, $filename);

    /**
     * @return stringc
     */
    public function getFileExtension();
}
