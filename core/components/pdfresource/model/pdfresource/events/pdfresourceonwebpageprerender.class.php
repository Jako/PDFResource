<?php

/**
 * @package pdfresource
 * @subpackage plugin
 */
class PDFResourceOnWebPagePrerender extends PDFResourcePlugin
{
    public function run()
    {
        // Generate the PDF on the fly once if it does not exist and live_pdf template variable is checked
        $c = $this->modx->newQuery('modTemplateVarTemplate');
        $c->leftJoin('modTemplateVar', 'modTemplateVar', array('modTemplateVarTemplate.tmplvarid = modTemplateVar.id'));
        $c->select($this->modx->getSelectColumns('modTemplateVar', 'modTemplateVar', '', array('name')));
        $c->select($this->modx->getSelectColumns('modTemplateVarTemplate', 'modTemplateVarTemplate', '', array('templateid')));
        $c->where(array(
            'modTemplateVar.name' => $this->pdfresource->getOption('pdfTvLive', null, 'live_pdf'),
            'modTemplateVarTemplate.templateid' => $this->modx->resource->get('template')
        ));
        // Check if the live_pdf template variable is assigned
        $assigned = $this->modx->getObject('modTemplateVarTemplate', $c);
        if ($assigned) {
            $livePDF = intval($this->modx->resource->getTVValue($this->pdfresource->getOption('pdfTvLive', null, 'live_pdf')));
            if ($livePDF) {
                header('Content-Type: application/pdf');
                header('Content-Disposition:inline;filename=' . $this->modx->resource->get('alias') . '.pdf');
                echo $this->pdfresource->createPDF($this->modx->resource, false);
                exit;
            }
        }
        // Generate the PDF once if it does not exist, create_pdf template variable is assigned and system setting generateOnPrerender is enabled
        if ($this->pdfresource->getOption('generateOnPrerender')) {
            $c = $this->modx->newQuery('modTemplateVarTemplate');
            $c->leftJoin('modTemplateVar', 'modTemplateVar', array('modTemplateVarTemplate.tmplvarid = modTemplateVar.id'));
            $c->select($this->modx->getSelectColumns('modTemplateVar', 'modTemplateVar', '', array('name')));
            $c->select($this->modx->getSelectColumns('modTemplateVarTemplate', 'modTemplateVarTemplate', '', array('templateid')));
            $c->where(array(
                'modTemplateVar.name' => $this->pdfresource->getOption('pdfTv', null, 'create_pdf'),
                'modTemplateVarTemplate.templateid' => $this->modx->resource->get('template')
            ));
            // Check if the create_pdf template variable is assigned, since it is enabled by default
            $assigned = $this->modx->getObject('modTemplateVarTemplate', $c);
            if ($assigned) {
                $aliasPath = $this->modx->resource->get('parent') ? preg_replace('#(\.[^./]*)$#', '/', $this->modx->makeUrl($this->modx->resource->get('parent'))) : '';
                $createPDF = intval($this->modx->resource->getTVValue($this->pdfresource->getOption('pdfTv', null, 'create_pdf')));
                if ($createPDF && !file_exists($this->pdfresource->getOption('pdfPath') . $aliasPath . $this->modx->resource->get('alias') . '.pdf')) {
                    $this->pdfresource->createPDF($this->modx->resource, $aliasPath);
                }
            }
        }
    }
}