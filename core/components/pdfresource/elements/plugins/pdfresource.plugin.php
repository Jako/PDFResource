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

$className = 'TreehillStudio\PDFResource\Plugins\Events\\' . $modx->event->name;

$corePath = $modx->getOption('pdfresource.core_path', null, $modx->getOption('core_path') . 'components/pdfresource/');
/** @var PDFResource $pdfresource */
$pdfresource = $modx->getService('pdfresource', 'PDFResource', $corePath . 'model/pdfresource/', [
    'core_path' => $corePath
]);

if ($pdfresource) {
    if (class_exists($className)) {
        $handler = new $className($modx, $scriptProperties);
        if (get_class($handler) == $className) {
            $handler->run();
        } else {
            $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' could not be initialized!', '', 'PDFResource Plugin');
        }
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, $className. ' was not found!', '', 'PDFResource Plugin');
    }
}

return;