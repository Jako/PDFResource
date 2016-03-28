<?php
/**
 * PDFResource
 *
 * Copyright 2015 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package pdfresource
 * @subpackage plugin
 *
 * PDFResource plugin
 */

/** @var modX $modx */
/** @var array $scriptProperties */
$pdfresourceCorePath = $modx->getOption('pdfresource.core_path', null, $modx->getOption('core_path') . 'components/pdfresource/');
$pdfresource = $modx->getService('pdfresource', 'PDFResource', $pdfresourceCorePath . 'model/pdfresource/', $scriptProperties);

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
            if (!$createPDF && file_exists($pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf')) {
                @unlink($pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf');
            } else {
                $modx->invokeEvent('OnHandleRequest', array()); // call ClientConfig if installed
                $modx->resource = &$resource;
                $pdfresource->createPDF($resource, $aliasPath);
            }
        }
        break;
    case 'OnWebPagePrerender':
        // Generate the PDF on the fly once if it does not exist and live_pdf template variable is checked
        $c = $modx->newQuery('modTemplateVarTemplate');
        $c->leftJoin('modTemplateVar', 'modTemplateVar', array('modTemplateVarTemplate.tmplvarid = modTemplateVar.id'));
        $c->select($modx->getSelectColumns('modTemplateVar', 'modTemplateVar', '', array('name')));
        $c->select($modx->getSelectColumns('modTemplateVarTemplate', 'modTemplateVarTemplate', '', array('templateid')));
        $c->where(array(
            'modTemplateVar.name' => $pdfresource->getOption('pdfTvLive', null, 'live_pdf'),
            'modTemplateVarTemplate.templateid' => $modx->resource->get('template')
        ));
        // Check if the live_pdf template variable is assigned
        $assigned = $modx->getObject('modTemplateVarTemplate', $c);
        if ($assigned) {
            $livePDF = intval($modx->resource->getTVValue($pdfresource->getOption('pdfTvLive', null, 'live_pdf')));
            if ($livePDF) {
                header('Content-Type: application/pdf');
                header('Content-Disposition:inline;filename=' . $modx->resource->get('alias') . '.pdf');
                echo $pdfresource->createPDF($modx->resource, false);
                exit;
            }
        }
        // Generate the PDF once if it does not exist, create_pdf template variable is assigned and system setting generateOnPrerender is enabled
        if ($pdfresource->getOption('generateOnPrerender')) {
            $c = $modx->newQuery('modTemplateVarTemplate');
            $c->leftJoin('modTemplateVar', 'modTemplateVar', array('modTemplateVarTemplate.tmplvarid = modTemplateVar.id'));
            $c->select($modx->getSelectColumns('modTemplateVar', 'modTemplateVar', '', array('name')));
            $c->select($modx->getSelectColumns('modTemplateVarTemplate', 'modTemplateVarTemplate', '', array('templateid')));
            $c->where(array(
                'modTemplateVar.name' => $pdfresource->getOption('pdfTv', null, 'create_pdf'),
                'modTemplateVarTemplate.templateid' => $modx->resource->get('template')
            ));
            // Check if the create_pdf template variable is assigned, since it is enabled by default
            $assigned = $modx->getObject('modTemplateVarTemplate', $c);
            if ($assigned) {
                $aliasPath = $modx->resource->get('parent') ? preg_replace('#(\.[^./]*)$#', '/', $modx->makeUrl($modx->resource->get('parent'))) : '';
                $createPDF = intval($modx->resource->getTVValue($pdfresource->getOption('pdfTv', null, 'create_pdf')));
                if ($createPDF && !file_exists($pdfresource->getOption('pdfPath') . $aliasPath . $modx->resource->get('alias') . '.pdf')) {
                    $pdfresource->createPDF($modx->resource, $aliasPath);
                }
            }
        }
}

return;
