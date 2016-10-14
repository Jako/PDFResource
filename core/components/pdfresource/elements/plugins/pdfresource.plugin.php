<?php
/**
 * PDFResource Plugin
 *
 * @package pdfresource
 * @subpackage plugin
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$corePath = $modx->getOption('pdfresource.core_path', null, $modx->getOption('core_path') . 'components/pdfresource/');
/** @var PDFResource $pdfresource */
$pdfresource = $modx->getService('pdfresource', 'PDFResource', $corePath . 'model/pdfresource/', array(
    'core_path' => $corePath
));

$className = 'PDFResource' . $modx->event->name;
$modx->loadClass('PDFResourcePlugin', $pdfresource->getOption('modelPath') . 'pdfresource/events/', true, true);
$modx->loadClass($className, $pdfresource->getOption('modelPath') . 'pdfresource/events/', true, true);
if (class_exists($className)) {
    /** @var PDFResourcePlugin $handler */
    $handler = new $className($modx, $scriptProperties);
    $handler->run();
}

return;