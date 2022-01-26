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
        $output = '';
        $input = $this->getProperty('input');

        if ($input) {
            if ($input == (isset($modx->resource)) ? $this->modx->resource->get('id') : 0) {
                $resource = &$this->modx->resource;
            } else {
                $resource = $this->modx->getObject('modResource', $input);
            }
            if ($resource) {
                $pdfPath = $this->modx->getOption('pdfresource.pdf_url', null, $this->modx->getOption('assets_url') . 'pdf/');
                $aliasPath = $this->pdfresource->getParentPath($resource);
                $output = $pdfPath . $aliasPath . $resource->get('alias') . '.pdf';
            }
        }

        return $output;
    }
}
