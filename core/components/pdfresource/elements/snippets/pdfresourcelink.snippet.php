<?php
/**
 * PDFResourceLink
 *
 * @package pdfresource
 * @subpackage snippet
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

use TreehillStudio\PDFResource\Snippets\PDFResourceLink;

$corePath = $modx->getOption('pdfresource.core_path', null, $modx->getOption('core_path') . 'components/pdfresource/');
/** @var PDFResource $pdfresource */
$pdfresource = $modx->getService('pdfresource', 'PDFResource', $corePath . 'model/pdfresource/', [
    'core_path' => $corePath
]);

$snippet = new PDFResourceLink($modx, $scriptProperties);
if ($snippet instanceof TreehillStudio\PDFResource\Snippets\PDFResourceLink) {
    return $snippet->execute();
}
return 'TreehillStudio\PDFResource\Snippets\PDFResourceLink class not found';