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

$output = '';

if ($input) {
    if ($input == $modx->resource->get('id')) {
        $resource = &$modx->resource;
    } else {
        $resource = $modx->getObject('modResource', $input);
    }
    if ($resource) {
        $pdfPath = $modx->getOption('pdfresource.pdf_url', null, $modx->getOption('assets_url') . 'pdf/');
        $aliasPath = $resource->get('parent') ? preg_replace('#(\.[^./]*)$#', '/', $modx->makeUrl($resource->get('parent'))) : '';
        $output = $pdfPath . $aliasPath . $resource->get('alias') . '.pdf';
    }
}

return $output;
