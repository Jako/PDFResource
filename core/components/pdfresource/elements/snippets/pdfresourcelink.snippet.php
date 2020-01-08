<?php
/**
 * PDFResourceLink
 *
 * @package pdfresource
 * @subpackage snippet
 *
 * @var modX $modx
 * @var string $input
 */

$corePath = $modx->getOption('pdfresource.core_path', null, $modx->getOption('core_path') . 'components/pdfresource/');
$pdfresource = $modx->getService('pdfresource', 'PDFResource', $corePath . 'model/pdfresource/', array(
    'core_path' => $corePath
));

$output = '';

if ($input) {
    if ($input == (isset($modx->resource)) ? $modx->resource->get('id') : 0) {
        $resource = &$modx->resource;
    } else {
        $resource = $modx->getObject('modResource', $input);
    }
    if ($resource) {
        $pdfPath = $modx->getOption('pdfresource.pdf_url', null, $modx->getOption('assets_url') . 'pdf/');
        $aliasPath = $pdfresource->getParentPath($resource);
        $output = $pdfPath . $aliasPath . $resource->get('alias') . '.pdf';
    }
}

return $output;
