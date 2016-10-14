<?php
/**
 * @package pdfresource
 * @subpackage plugin
 */

class PDFResourceOnDocFormSave extends PDFResourcePlugin
{
    public function run()
    {
        // Generate the PDF if create_pdf template variable is checked
        $resource = $this->modx->getOption('resource', $this->scriptProperties, '');
        /** @var xPDOQuery $c */
        $c = $this->modx->newQuery('modTemplateVarTemplate');
        $c->leftJoin('modTemplateVar', 'modTemplateVar', array('modTemplateVarTemplate.tmplvarid = modTemplateVar.id'));
        $c->select($this->modx->getSelectColumns('modTemplateVar', 'modTemplateVar', '', array('name')));
        $c->select($this->modx->getSelectColumns('modTemplateVarTemplate', 'modTemplateVarTemplate', '', array('templateid')));
        $c->where(array(
            'modTemplateVar.name' => $this->pdfresource->getOption('pdfTv', null, 'create_pdf'),
            'modTemplateVarTemplate.templateid' => $resource->get('template')
        ));
        $assigned = $this->modx->getObject('modTemplateVarTemplate', $c);
        if ($assigned) {
            $this->modx->switchContext($resource->context_key);
            $aliasPath = $resource->get('parent') ? preg_replace('#(\.[^./]*)$#', '/', $this->modx->makeUrl($resource->get('parent'))) : '';
            $this->modx->switchContext('mgr');

            $createPDF = intval($resource->getTVValue($this->pdfresource->getOption('pdfTv', null, 'create_pdf')));
            if (!$createPDF && file_exists($this->pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf')) {
                @unlink($this->pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf');
            } else {
                $this->modx->invokeEvent('OnHandleRequest', array()); // call ClientConfig if installed
                $this->modx->resource = &$resource;
                $this->pdfresource->createPDF($resource, $aliasPath);
            }
        }
    }
}