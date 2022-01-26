<?php
/**
 * modPDF
 *
 * @package pdfresource
 * @subpackage classfile
 */

namespace TreehillStudio\PDFResource;

use modX;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use xPDO\xPDO;

/**
 * Class modPDF
 *
 * Extended mPDF class and use the MODX log for error messages
 */
class modPDF extends Mpdf
{
    /**
     * A reference to the modX instance
     * @var modX $modx
     */
    public $modx;

    /**
     * The namespace
     * @var string $namespace
     */
    public $namespace = 'modpdf';

    /**
     * The version
     * @var string $version
     */
    public $version = '1.1.0';

    /**
     * The class options
     * @var array $options
     */
    public $options = [];

    /**
     * modPDF constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     * @throws MpdfException
     */
    function __construct(modX &$modx, array $options = [])
    {
        $this->modx =& $modx;

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path') . 'components/' . $this->namespace . '/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path') . 'components/' . $this->namespace . '/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url') . 'components/' . $this->namespace . '/');
        $pdfPath = $this->getOption('pdf_path', $options, $this->modx->getOption('assets_path') . 'pdf/');
        $pdfUrl = $this->getOption('pdf_url', $options, $this->modx->getOption('assets_url') . 'pdf/');

        // Load some default paths for easier management
        $this->options = array_merge([
            'namespace' => $this->namespace,
            'version' => $this->version,
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'imagesUrl' => $assetsUrl . 'images/',
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'vendorPath' => $corePath . 'vendor/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'pagesPath' => $corePath . 'elements/pages/',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'pluginsPath' => $corePath . 'elements/plugins/',
            'controllersPath' => $corePath . 'controllers/',
            'processorsPath' => $corePath . 'processors/',
            'templatesPath' => $corePath . 'templates/',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'pdfPath' => $pdfPath,
            'pdfUrl' => $pdfUrl,
        ], $options);

        parent::__construct([
            'mode' => $this->getOption('mode', $options, ''),
            'format' => $this->getOption('format', $options, 'A4'),
            'default_font_size' => (int)$this->getOption('defaultFontSize', $options, ''),
            'default_font' => $this->getOption('defaultFont', $options, 'A4'),
            'margin_left' => (int)$this->getOption('mgl', $options, 15),
            'margin_right' => (int)$this->getOption('mgr', $options, 15),
            'margin_top' => (int)$this->getOption('mgt', $options, 16),
            'margin_bottom' => (int)$this->getOption('mgb', $options, 16),
            'margin_header' => (int)$this->getOption('mgh', $options, 9),
            'margin_footer' => (int)$this->getOption('mgf', $options, 9),
            'orientation' => $this->getOption('orientation', $options, 'P'),
        ]);

        $customFonts = $this->getOption('customFonts', $options, '[]');
        $customFonts = (!is_array($customFonts)) ? json_decode($customFonts, true) : $customFonts;

        if (is_array($customFonts)) {
            foreach ($customFonts as $f => $fs) {
                $this->fontdata[$f] = $fs;
                if (isset($fs['R']) && $fs['R']) {
                    $this->available_unifonts[] = $f;
                }
                if (isset($fs['B']) && $fs['B']) {
                    $this->available_unifonts[] = $f . 'B';
                }
                if (isset($fs['I']) && $fs['I']) {
                    $this->available_unifonts[] = $f . 'I';
                }
                if (isset($fs['BI']) && $fs['BI']) {
                    $this->available_unifonts[] = $f . 'BI';
                }
            }
        } elseif ($this->getOption('customFonts', $options, '') != '') {
            $this->modx->log(xPDO::LOG_LEVEL_ERROR, 'customFonts does not contain a JSON encoded array.', '', 'modPDF');
        }

        $this->default_available_fonts = $this->available_unifonts;
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param string $key The option key to search for.
     * @param array $options An array of options that override local options.
     * @param mixed $default The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     * @return mixed The option value or the default value specified.
     */
    public function getOption($key, $options = [], $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("$this->namespace.$key", $this->modx->config)) {
                $option = $this->modx->getOption("$this->namespace.$key");
            }
        }
        return $option;
    }
}
