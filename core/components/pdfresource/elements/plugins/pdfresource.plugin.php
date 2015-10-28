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
        $modx->switchContext($resource->context_key);
        $aliasPath = preg_replace('#(.*/)[^/]*(.html|/)#', '$1', $modx->makeUrl($resource->get('id')));
        $modx->switchContext('mgr');

        /** @var modResource $resource */
        $createPDF = intval($resource->getTVValue($pdfresource->getOption('pdfTv', null, 'create_pdf')));
        if (!$createPDF) {
            @unlink($pdfresource->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf');
        } else {
            $modx->invokeEvent('OnHandleRequest', array()); // call ClientConfig if installed
            $pdfresource->createPDF($resource, $aliasPath);
        }
        break;
    case 'OnWebPagePrerender':
        $modx->switchContext($modx->resource->context_key);
        $aliasPath = preg_replace('#(.*/)[^/]*(.html|/)#', '$1', $modx->makeUrl($modx->resource->get('id')));
        $modx->switchContext('mgr');

        /** @var modResource $modx ->resource */
        $createPDF = intval($modx->resource->getTVValue($pdfresource->getOption('pdfTv', null, 'create_pdf')));
        if ($createPDF && !file_exists($pdfresource->getOption('pdfPath') . $aliasPath . $modx->resource->get('alias') . '.pdf')) {
            $pdfresource->createPDF($modx->resource, $aliasPath);
        }
        break;
}

return;

