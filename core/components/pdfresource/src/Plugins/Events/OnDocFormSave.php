<?php
/**
 * @package pdfresource
 * @subpackage plugin
 */

namespace TreehillStudio\PDFResource\Plugins\Events;

use modResource;
use modTemplateVar;
use TreehillStudio\PDFResource\Plugins\Plugin;

/**
 * @package pdfresource
 * @subpackage plugin
 */
class OnDocFormSave extends Plugin
{
    public function process()
    {
        // Generate the PDF if create_pdf template variable is checked
        /** @var modResource $resource */
        $resource = $this->modx->getOption('resource', $this->scriptProperties, '');
        /** @var modTemplateVar[] $tvs */
        $tvs = $resource->getTemplateVars();
        foreach ($tvs as $tv) {
            if ($tv->get('name') == $this->pdfresource->getOption('pdfTv', [], 'create_pdf')) {
                $this->modx->switchContext($resource->context_key);
                $aliasPath = $this->pdfresource->getParentPath($resource);
                $this->modx->switchContext('mgr');

                $createPDF = intval($tv->getValue($resource->get('id')));
                if (!$createPDF && file_exists($this->pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf')) {
                    @unlink($this->pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf');
                } elseif ($createPDF) {
                    $this->modx->invokeEvent('OnHandleRequest', []); // call ClientConfig if installed
                    $this->modx->resource = &$resource;
                    $this->pdfresource->createPDF($resource, $aliasPath);
                }
            }
        }
    }
}
