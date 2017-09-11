<?php
/** @var array $options */
/** @var xPDOObject $object */
if ($object->xpdo) {

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            /** @var modX $modx */
            $modx =& $object->xpdo;

            $corepath = $modx->getOption('pdfresource.core_path', null, $modx->getOption('core_path') . 'components/pdfresource/');
            $assetspath = $modx->getOption('assets_path');

            // Create folders
            $folders = array(
                $assetspath . 'pdf',
                $corepath . 'vendor/mpdf/mpdf/graph_cache',
                $corepath . 'vendor/mpdf/mpdf/tmp',
                $corepath . 'vendor/mpdf/mpdf/ttfontdata'
            );

            $cacheManager = $modx->getCacheManager();
            foreach ($folders as $folder) {
                if (!file_exists($folder) || !is_dir($folder)) {
                    if (!$cacheManager->writeTree($targetDir)) {
                        $modx->log(xPDO::LOG_LEVEL_ERROR, 'Folder "' . $folder . '" could not be created.');
                    }
                }
            }
            break;
    }
}
$modx->log(xPDO::LOG_LEVEL_INFO, 'PDFResource custom folders were created.');
return true;
