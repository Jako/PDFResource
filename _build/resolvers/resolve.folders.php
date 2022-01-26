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

if (isset($object) && isset($object->xpdo)) {
    /** @var modX $modx */
    $modx = &$object->xpdo;
    $resolver = true;
} else {
    if (!($modx instanceof modX)) {
        require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php');
        require_once MODX_CORE_PATH . 'model/modx/modx.class.php';

        /** @var modX $modx */
        $modx = new modX();
        $modx->initialize('web');
        $modx->getService('error', 'error.modError', '', '');
        $modx->getService('xPDOTransport', 'xpdo.transport.xPDOTransport', MODX_CORE_PATH, '');
    }
    $resolver = false;
    $options = [xPDOTransport::PACKAGE_ACTION => xPDOTransport::ACTION_INSTALL];
}

$success = true;
$output = '';

switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        $corepath = $modx->getOption('pdfresource.core_path', null, $modx->getOption('core_path') . 'components/pdfresource/');
        $assetspath = $modx->getOption('assets_path');

        // Create folders
        $folders = [
            $assetspath . 'pdf',
            $corepath . 'vendor/mpdf/mpdf/graph_cache',
            $corepath . 'vendor/mpdf/mpdf/tmp',
            $corepath . 'vendor/mpdf/mpdf/ttfontdata'
        ];

        $cacheManager = $modx->getCacheManager();
        foreach ($folders as $folder) {
            if (!file_exists($folder) || !is_dir($folder)) {
                if (!$cacheManager->writeTree($folder)) {
                    $message = 'Folder "' . $folder . '" could not be created.';
                    $modx->log(xPDO::LOG_LEVEL_ERROR, $message);
                    $output .= $message . "\n";
                    $success = false;
                }
            } else {
                if (!@is_writable($folder)) {
                    if (!@chmod($folder, octdec($modx->getOption('new_folder_permissions', null, '0775')))) {
                        $message = 'Folder "' . $folder . '" cannot set writable.';
                        $modx->log(xPDO::LOG_LEVEL_INFO, $message);
                        $output .= $message . "\n";
                        $success = false;
                    }
                }
            }
        }
        break;
}
if ($success) {
    $message = 'PDFResource custom folders were created.';
    $modx->log(xPDO::LOG_LEVEL_INFO, $message);
    $output .= $message . "\n";
}

if (!$resolver) {
    exit($output);
}

return $success;
