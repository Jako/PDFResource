<?php
/**
 * PDFResourceLink Snippet
 *
 * @package pdfresource
 * @subpackage snippet
 */

namespace TreehillStudio\PDFResource\Snippets;

class PDFResourceLink extends Snippet
{
    /**
     * Get default snippet properties.
     *
     * @return array
     */
    public function getDefaultProperties()
    {
        return [
            'input' => '',
            'options' => '',
            'name' => '',
        ];
    }

    /**
     * Execute the snippet and return the result.
     *
     * @return string
     * @throws /Exception
     */
    public function execute()
    {
        $output = '-';
        $input = $this->getProperty('input');

        if ($input) {
            if ($input == (isset($modx->resource)) ? $this->modx->resource->get('id') : 0) {
                $resource = &$this->modx->resource;
            } else {
                $resource = $this->modx->getObject('modResource', $input);
            }
            if ($resource) {
                $pdfUrl = $this->pdfresource->getOption('pdfUrl');
                $pdfPath = $this->pdfresource->getOption('pdfPath');
                $aliasPath = $this->pdfresource->getParentPath($resource);
                if (file_exists($pdfPath . $aliasPath . $resource->get('alias') . '.pdf')) {
                    $output = $pdfUrl . $aliasPath . $resource->get('alias') . '.pdf';
                }
            }
        }

        return $output;
    }
}
