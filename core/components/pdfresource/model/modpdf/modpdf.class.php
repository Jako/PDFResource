<?php
/**
 * modPDF
 *
 * Copyright 2015 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package modpdf
 * @subpackage classfile
 */

/**
 * Class modPDF
 *
 * Extended mPDF class that uses the MODX log for Error messages
 */

class modPDF extends mPDF
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
    public $version = '1.0.0';

    /**
     * The class options
     * @var array $options
     */
    public $options = array();

    /**
     * PDFResource constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    function __construct(modX &$modx, array $options = array())
    {
        $this->modx = &$modx;

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path') . 'components/' . $this->namespace . '/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path') . 'components/' . $this->namespace . '/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url') . 'components/' . $this->namespace . '/');
        $pdfPath = $this->getOption('pdf_path', $options, $this->modx->getOption('assets_path') . 'pdf/');
        $pdfUrl = $this->getOption('pdf_url', $options, $this->modx->getOption('assets_url') . 'pdf/');

        // Load some default paths for easier management
        $this->options = array_merge(array(
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
        ), $options);

        // Init mPDF options
        $mode = $this->modx->getOption('mode', $options, '');
        $format = $this->modx->getOption('format', $options, 'A4');
        $default_font_size = intval($this->modx->getOption('defaultFontSize', $options, 0));
        $default_font = $this->modx->getOption('defaultFont', $options, '');
        $mgl = intval($this->modx->getOption('mgl', $options, 15));
        $mgr = intval($this->modx->getOption('mgr', $options, 15));
        $mgt = intval($this->modx->getOption('mgt', $options, 16));
        $mgb = intval($this->modx->getOption('mgb', $options, 16));
        $mgh = intval($this->modx->getOption('mgb', $options, 9));
        $mgf = intval($this->modx->getOption('mgf', $options, 9));
        $orientation = $this->modx->getOption('orientation', $options, 'P');

        parent::mPDF($mode, $format, $default_font_size, $default_font, $mgl, $mgr, $mgt, $mgb, $mgh, $mgf, $orientation);

        $customFonts = $this->modx->fromJSON($this->modx->getOption('customFonts', $options, '[]'));

        if (is_array($customFonts)) {
            foreach($customFonts as $f => $fs) {
                $this->fontdata[$f] = $fs;
                if (isset($fs['R']) && $fs['R']) { $this->available_unifonts[] = $f; }
                if (isset($fs['B']) && $fs['B']) { $this->available_unifonts[] = $f.'B'; }
                if (isset($fs['I']) && $fs['I']) { $this->available_unifonts[] = $f.'I'; }
                if (isset($fs['BI']) && $fs['BI']) { $this->available_unifonts[] = $f.'BI'; }
            }
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'customFonts does not contain an array.', '', 'modPDF');
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
    public function getOption($key, $options = array(), $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("{$this->namespace}.{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}.{$key}");
            }
        }
        return $option;
    }

    /**
     * @param $msg
     */
    function Error($msg)
    {
        $this->modx->log(modX::LOG_LEVEL_ERROR, $msg, '', 'modPDF');
        parent::Error($msg);
    }
}
