<?php
/**
 * PDFResource
 *
 * Copyright 2015 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * @package pdfresource
 * @subpackage classfile
 */

/**
 * Class PDFResource
 */
class PDFResource
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
    public $namespace = 'pdfresource';

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
     * An modPDF object instance
     * @var modPDF $pdf
     */
    public $pdf;

    /**
     * Template cache
     * @var array $_tplCache
     */
    private $_tplCache;

    /**
     * Valid binding types
     * @var array $_validTypes
     */
    private $_validTypes = array(
        '@CHUNK',
        '@FILE',
        '@INLINE'
    );

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
        $this->options = array(
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
        );
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
     * Initialize the modPDF class
     *
     * @param array $options
     */
    public function initPDF($options)
    {
        // Autoload composer classes
        require $this->getOption('corePath') . 'vendor/autoload.php';

        if (!$this->modx->loadClass('modpdf.modpdf', $this->options['modelPath'], true, true)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Could not load modPDF class.');
            return;
        }

        $this->pdf = new modPDF($this->modx, array(
            'mode' => $this->getOption('mode', $options),
            'format' => $this->getOption('format', $options),
            'defaultFontSize' => $this->getOption('defaultFontSize', $options),
            'defaultFont' => $this->getOption('defaultFont', $options),
            'mgl' => $this->getOption('mgl', $options),
            'mgr' => $this->getOption('mgr', $options),
            'mgt' => $this->getOption('mgt', $options),
            'mgb' => $this->getOption('mgb', $options),
            'mgh' => $this->getOption('mgh', $options),
            'mgf' => $this->getOption('mgf', $options),
            'orientation' => $this->getOption('orientation', $options),
            'customFonts' => $this->getOption('customFonts', $options)
        ));
    }

    /**
     * Create a PDF with the options set in the class
     *
     * @param modResource $resource
     * @param string|boolean $aliasPath
     * @return string
     */
    public function createPDF($resource, $aliasPath)
    {
        // Create folders
        if (!@is_dir($this->getOption('pdfPath'))) {
            if (!@mkdir($this->getOption('pdfPath'), $this->modx->getOption('new_folder_permissions', null, 0775))) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'Could not create the pdf output path: ' . $this->getOption('pdfPath'), '', 'PDFResource');
                return '';
            };
        }
        if ($aliasPath && !@is_dir($this->getOption('pdfPath') . $aliasPath)) {
            if (!@mkdir($this->getOption('pdfPath') . $aliasPath, $this->modx->getOption('new_folder_permissions', null, 0775))) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'Could not create the pdf alias path: ' . $this->getOption('pdfPath') . $aliasPath, '', 'PDFResource');
                return '';
            };
        }

        // Get options
        $id = $resource->get('id');
        $pdfTpl = $this->getOption('pdfTpl', null, 'tplPDF');
        $cssTpl = $this->getOption('cssTpl', null, 'tplCSS');
        $optionsTV = $this->getOption('pdfTvOptions', null, 'pdf_options');
        $processTVs = $this->getOption('processTVs', null, false);
        $tvPrefix = $this->getOption('tvPrefix', null, 'tv.');

        $placeholder = $resource->toArray();

        // Prepare template variables and resource based options
        $pdfOptions = null;
        $tvs = $this->modx->getCollection('modTemplateVar');
        foreach ($tvs as $tv) {
            /** @var modTemplateVar $tv */
            $placeholder[$tvPrefix . $tv->get('name')] = ($processTVs) ? $tv->renderOutput($id) : $tv->getValue($id);
            if ($tv->get('name') == $optionsTV && $tv->getValue($id) != '') {
                $pdfOptions = json_decode($tv->getValue($id), true);
                if ($pdfOptions) {
                    $pdfTpl = $this->modx->getOption('pdfTpl', $pdfOptions, $pdfTpl);
                    $cssTpl = $this->modx->getOption('cssTpl', $pdfOptions, $cssTpl);
                }
            }
        }

        // Parse template chunks
        $placeholder['tplPath'] = $this->modx->getOption('assets_path');
        $html = $this->getChunk($pdfTpl, $placeholder);
        $this->modx->getParser()->processElementTags('', $html, false, false, '[[', ']]', array(), $this->modx->getOption('max_iterations'));
        $this->modx->getParser()->processElementTags('', $html, true, true, '[[', ']]', array(), $this->modx->getOption('max_iterations'));
        $css = $this->getChunk($cssTpl, $placeholder);
        unset($placeholder);

        // Generate PDF file
        $this->initPDF(array(
            'mode' => $this->getOption('mode', $pdfOptions, 'utf-8'),
            'format' => $this->getOption('format', $pdfOptions, 'A4'),
            'defaultFontSize' => intval($this->getOption('defaultFontSize', $pdfOptions, 8)),
            'defaultFont' => $this->getOption('defaultFont', $pdfOptions, ''),
            'mgl' => intval($this->getOption('mgl', $pdfOptions, 10)),
            'mgr' => intval($this->getOption('mgr', $pdfOptions, 10)),
            'mgt' => intval($this->getOption('mgt', $pdfOptions, 7)),
            'mgb' => intval($this->getOption('mgb', $pdfOptions, 7)),
            'mgh' => intval($this->getOption('mgh', $pdfOptions, 10)),
            'mgf' => intval($this->getOption('mgf', $pdfOptions, 10)),
            'orientation' => $this->getOption('orientation', $pdfOptions, 'P'),
            'customFonts' => $this->getOption('customFonts', $pdfOptions, '[]')
        ));

        $this->pdf->SetTitle($resource->get('pagetitle'));
        $this->pdf->SetAuthor($this->getOption('author', $pdfOptions, $this->modx->getOption('site_name')));
        $this->pdf->SetCreator($this->getOption('creator', $pdfOptions, $this->modx->getOption('site_url') . ' powered by PDFResource/mPDF'));

        // Password protection
        $userPassword = $this->getOption('userPassword', $pdfOptions, '');
        $ownerPassword = $this->getOption('ownerPassword', $pdfOptions, '');
        $permissions = json_decode($this->getOption('permissions', $pdfOptions, ''), true);
        if ($userPassword || $ownerPassword) {
            // Set default permissions if needed
            $permissions = ($permissions) ? $permissions : array();
            // Random owner password if needed
            $ownerPassword = ($ownerPassword) ? $ownerPassword : null;
            $this->pdf->SetProtection($permissions, $userPassword, $ownerPassword, 128);
        }

        // Call additional mPDF methods
        $mpdfMethods = json_decode($this->getOption('mPDFMethods', $pdfOptions, ''), true);
        $mpdfMethods = (is_array($mpdfMethods)) ? $mpdfMethods : array();
        foreach ($mpdfMethods as $methodName) {
            $value = $this->getOption($methodName, $pdfOptions, '');
            $value = (is_array($value)) ? $value : json_decode($value, true);
            if ($value && method_exists($this->pdf, $methodName)) {
                call_user_func_array(array($this->pdf, $methodName), $value);
            }
        }

        $this->pdf->WriteHTML($css, 1);
        $this->pdf->WriteHTML($html, 2);

        if ($aliasPath) {
            return $this->pdf->Output($this->getOption('pdfPath') . $aliasPath . $resource->get('alias') . '.pdf', 'F');
        } else {
            return $this->pdf->Output('', 'S');
        }
    }

    /**
     * Parse a chunk (with template bindings)
     * Modified parseTplElement method from getResources package (https://github.com/opengeek/getResources)
     *
     * @param $type
     * @param $source
     * @param null $properties
     * @return bool
     */
    private function parseChunk($type, $source, $properties = null)
    {
        $output = false;

        if (!is_string($type) || !in_array($type, $this->_validTypes)) {
            $type = $this->modx->getOption('tplType', $properties, '@CHUNK');
        }

        $content = false;
        switch ($type) {
            case '@FILE':
                $path = $this->modx->getOption('tplPath', $properties, $this->modx->getOption('assets_path', $properties, MODX_ASSETS_PATH) . 'elements/chunks/');
                $key = $path . $source;
                if (!isset($this->_tplCache['@FILE'])) {
                    $this->_tplCache['@FILE'] = array();
                }
                if (!array_key_exists($key, $this->_tplCache['@FILE'])) {
                    if (file_exists($key)) {
                        $content = file_get_contents($key);
                    }
                    $this->_tplCache['@FILE'][$key] = $content;
                } else {
                    $content = $this->_tplCache['@FILE'][$key];
                }
                if (!empty($content) && $content !== '0') {
                    $chunk = $this->modx->newObject('modChunk', array('name' => $key));
                    $chunk->setCacheable(false);
                    $output = $chunk->process($properties, $content);
                }
                break;
            case '@INLINE':
                $uniqid = uniqid();
                $chunk = $this->modx->newObject('modChunk', array('name' => "{$type}-{$uniqid}"));
                $chunk->setCacheable(false);
                $output = $chunk->process($properties, $source);
                break;
            case '@CHUNK':
            default:
                $chunk = null;
                if (!isset($this->_tplCache['@CHUNK'])) {
                    $this->_tplCache['@CHUNK'] = array();
                }
                if (!array_key_exists($source, $this->_tplCache['@CHUNK'])) {
                    if ($chunk = $this->modx->getObject('modChunk', array('name' => $source))) {
                        $this->_tplCache['@CHUNK'][$source] = $chunk->toArray('', true);
                    } else {
                        $this->_tplCache['@CHUNK'][$source] = false;
                    }
                } elseif (is_array($this->_tplCache['@CHUNK'][$source])) {
                    $chunk = $this->modx->newObject('modChunk');
                    $chunk->fromArray($this->_tplCache['@CHUNK'][$source], '', true, true, true);
                }
                if (is_object($chunk)) {
                    $chunk->setCacheable(false);
                    $output = $chunk->process($properties);
                }
                break;
        }
        return $output;
    }

    /**
     * Get and parse a chunk (with template bindings)
     * Modified parseTpl method from getResources package (https://github.com/opengeek/getResources)
     *
     * @param $tpl
     * @param null $properties
     * @return bool
     */
    public function getChunk($tpl, $properties = null)
    {
        $output = false;
        if (!empty($tpl)) {
            $bound = array(
                'type' => '@CHUNK',
                'value' => $tpl
            );
            if (strpos($tpl, '@') === 0) {
                $endPos = strpos($tpl, ' ');
                if ($endPos > 2 && $endPos < 10) {
                    $tt = substr($tpl, 0, $endPos);
                    if (in_array($tt, $this->_validTypes)) {
                        $bound['type'] = $tt;
                        $bound['value'] = substr($tpl, $endPos + 1);
                    }
                }
            }
            if (is_array($bound) && isset($bound['type']) && isset($bound['value'])) {
                $output = $this->parseChunk($bound['type'], $bound['value'], $properties);
            }
        }
        return $output;
    }
}
