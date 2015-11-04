<?php
/**
 * PDFresource
 *
 * Copyright 2015 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package pdfresource
 * @subpackage plugin
 *
 * PDFresource plugin
 */

/** @var modX $modx */
/** @var array $scriptProperties */
$pdfresourceCorePath = $modx->getOption('pdfresource.core_path', null, $modx->getOption('core_path') . 'components/pdfresource/');
$pdfresource = $modx->getService('pdfresource', 'PDFresource', $pdfresourceCorePath . 'model/pdfresource/', $scriptProperties);

$eventName = $modx->event->name;
switch ($eventName) {
    case 'OnDocFormSave':
        /** @var modResource $resource */
        $c = $modx->newQuery('modTemplateVarTemplate');
        $c->leftJoin('modTemplateVar', 'modTemplateVar', array('modTemplateVarTemplate.tmplvarid = modTemplateVar.id'));
        $c->select($modx->getSelectColumns('modTemplateVar', 'modTemplateVar', '', array('name')));
        $c->select($modx->getSelectColumns('modTemplateVarTemplate', 'modTemplateVarTemplate', '', array('templateid')));
        $c->where(array(
            'modTemplateVar.name' => $pdfresource->getOption('pdfTv', null, 'create_pdf'),
            'modTemplateVarTemplate.templateid' => $resource->get('template')
        ));
        $assigned = $modx->getObject('modTemplateVarTemplate', $c);
        if ($assigned) {
            $modx->switchContext($resource->context_key);
            $aliasPath = $resource->get('parent') ? preg_replace('#(\.[^./]*)$#', '/', $modx->makeUrl($resource->get('parent'))) : '';
            $modx->switchContext('mgr');

            $createPDF = intval($resource->getTVValue($pdfresource->getOption('pdfTv', null, 'create_pdf')));
            if (!$createPDF) {
                @unlink($pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf');
            } else {
                $modx->invokeEvent('OnHandleRequest', array()); // call ClientConfig if installed
                $pdfresource->createPDF($resource, $aliasPath);
            }
        }
        break;
    case 'OnWebPagePrerender':
        if ($pdfresource->getOption('generateOnPrerender')) {
            $c = $modx->newQuery('modTemplateVarTemplate');
            $c->leftJoin('modTemplateVar', 'modTemplateVar', array('modTemplateVarTemplate.tmplvarid = modTemplateVar.id'));
            $c->select($modx->getSelectColumns('modTemplateVar', 'modTemplateVar', '', array('name')));
            $c->select($modx->getSelectColumns('modTemplateVarTemplate', 'modTemplateVarTemplate', '', array('templateid')));
            $c->where(array(
                'modTemplateVar.name' => $pdfresource->getOption('pdfTv', null, 'create_pdf'),
                'modTemplateVarTemplate.templateid' => $modx->resource->get('template')
            ));
            $assigned = $modx->getObject('modTemplateVarTemplate', $c);
            if ($assigned) {
                $aliasPath = $modx->resource->get('parent') ? preg_replace('#(\.[^./]*)$#', '/', $modx->makeUrl($modx->resource->get('parent'))) : '';
                $createPDF = intval($modx->resource->getTVValue($pdfresource->getOption('pdfTv', null, 'create_pdf')));
                if ($createPDF && !file_exists($pdfresource->getOption('pdfPath') . $aliasPath . $modx->resource->get('alias') . '.pdf')) {
                    $pdfresource->createPDF($modx->resource, $aliasPath);
                }
            }
        }
        break;
}

return;
