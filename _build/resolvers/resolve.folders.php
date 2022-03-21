<?php
/**
 * Resolve create folders
 *
 * @package pdfresource
 * @subpackage build
 *
 * @var array $options
 * @var xPDOObject $object
 */

/** @var xPDO $modx */
$modx =& $object->xpdo;

$success = true;

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        $assetspath = $modx->getOption('assets_path');

        // Create folders
        $folders = [
            $assetspath . 'pdf',
        ];

        $cacheManager = $modx->getCacheManager();
        foreach ($folders as $folder) {
            if (!file_exists($folder) || !is_dir($folder)) {
                if (!$cacheManager->writeTree($folder)) {
                    $modx->log(xPDO::LOG_LEVEL_ERROR, 'Folder "' . $folder . '" could not be created.');
                    $success = false;
                }
            } else {
                if (!@is_writable($folder)) {
                    if (!@chmod($folder, octdec($modx->getOption('new_folder_permissions', null, '0775')))) {
                        $modx->log(xPDO::LOG_LEVEL_INFO, 'Folder "' . $folder . '" could not set writable.');
                        $success = false;
                    }
                }
            }
        }
        break;
}
if ($success) {
    $modx->log(xPDO::LOG_LEVEL_INFO, 'PDFResource custom folders were created.');
}

return $success;
