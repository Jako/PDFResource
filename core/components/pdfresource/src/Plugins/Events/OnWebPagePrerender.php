<?php
/**
 * @package pdfresource
 * @subpackage plugin
 */

namespace TreehillStudio\PDFResource\Plugins\Events;

use modResource;
use modTemplateVar;
use TreehillStudio\PDFResource\Plugins\Plugin;

class OnWebPagePrerender extends Plugin
{
    public function process()
    {
        // Generate the PDF on the fly if it does not exist and live_pdf template variable is checked
        /** @var modResource $resource */
        $resource = &$this->modx->resource;
        /** @var modTemplateVar[] $tvs */
        $tvs = $resource->getTemplateVars();
        foreach ($tvs as $tv) {
            if ($tv->get('name') == $this->pdfresource->getOption('pdfTvLive', [], 'live_pdf')) {
                $livePDF = intval($tv->getValue($resource->get('id')));
                if ($livePDF) {
                    $this->modx->invokeEvent('OnHandleRequest', []); // call ClientConfig if installed
                    $this->pdfresource->createPDF($resource);
                    exit;
                }
            }
        }

        // Generate the PDF once if it does not exist, create_pdf template variable is assigned and system setting generateOnPrerender is enabled
        if ($this->pdfresource->getOption('generateOnPrerender') || $this->pdfresource->getOption('debug')) {
            foreach ($tvs as $tv) {
                if ($tv->get('name') == $this->pdfresource->getOption('pdfTv', [], 'create_pdf')) {
                    $this->modx->switchContext($resource->context_key);
                    $aliasPath = $this->pdfresource->getParentPath($resource);
                    $this->modx->switchContext('mgr');

                    $createPDF = intval($tv->getValue($resource->get('id')));
                    if (($createPDF && !file_exists($this->pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf')) ||
                        ($this->pdfresource->getOption('debug') && in_array($this->modx->getOption('mode', $_GET, ''), ['html', 'css']))
                    ) {
                        $this->modx->invokeEvent('OnHandleRequest', []); // call ClientConfig if installed
                        $this->pdfresource->createPDF($resource, $aliasPath);
                    }
                }
            }
        }
    }
}
