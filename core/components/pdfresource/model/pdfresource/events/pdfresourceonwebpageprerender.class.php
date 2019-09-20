<?php
/**
 * @package pdfresource
 * @subpackage plugin
 */

class PDFResourceOnWebPagePrerender extends PDFResourcePlugin
{
    public function run()
    {
        // Generate the PDF on the fly if it does not exist and live_pdf template variable is checked
        /** @var modResource $resource */
        $resource = &$this->modx->resource;
        /** @var modTemplateVar[] $tvs */
        $tvs = $resource->getTemplateVars();
        foreach ($tvs as $tv) {
            if ($tv->get('name') == $this->pdfresource->getOption('pdfTvLive', array(), 'live_pdf')) {
                $livePDF = intval($tv->getValue($resource->get('id')));
                if ($livePDF) {
                    $this->modx->invokeEvent('OnHandleRequest', array()); // call ClientConfig if installed
                    header('Content-Type: application/pdf');
                    header('Content-Disposition:inline;filename=' . $resource->get('alias') . '.pdf');
                    echo $this->pdfresource->createPDF($resource, false);
                    exit;
                }
            }
        }

        // Generate the PDF once if it does not exist, create_pdf template variable is assigned and system setting generateOnPrerender is enabled
        if ($this->pdfresource->getOption('generateOnPrerender')) {
            foreach ($tvs as $tv) {
                if ($tv->get('name') == $this->pdfresource->getOption('pdfTv', array(), 'create_pdf')) {
                    $this->modx->switchContext($resource->context_key);
                    $aliasPath = $this->pdfresource->getParentPath($resource);
                    $this->modx->switchContext('mgr');

                    $createPDF = intval($tv->getValue($resource->get('id')));
                    if ($createPDF && !file_exists($this->pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf')) {
                        $this->modx->invokeEvent('OnHandleRequest', array()); // call ClientConfig if installed
                        $this->pdfresource->createPDF($resource, $aliasPath);
                    }
                }
            }
        }
    }
}
