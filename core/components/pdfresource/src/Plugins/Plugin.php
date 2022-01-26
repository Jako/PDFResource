<?php
/**
 * Abstract plugin
 *
 * @package pdfresource
 * @subpackage plugin
 */

namespace TreehillStudio\PDFResource\Plugins;

use modX;
use PDFResource;

/**
 * Class Plugin
 */
abstract class Plugin
{
    /** @var modX $modx */
    protected $modx;
    /** @var PDFResource $pdfresource */
    protected $pdfresource;
    /** @var array $scriptProperties */
    protected $scriptProperties;

    /**
     * Plugin constructor.
     *
     * @param $modx
     * @param $scriptProperties
     */
    public function __construct($modx, &$scriptProperties)
    {
        $this->scriptProperties = &$scriptProperties;
        $this->modx =& $modx;
        $corePath = $this->modx->getOption('pdfresource.core_path', null, $this->modx->getOption('core_path') . 'components/pdfresource/');
        $this->pdfresource = $this->modx->getService('pdfresource', 'PDFResource', $corePath . 'model/pdfresource/', [
            'core_path' => $corePath
        ]);
    }

    /**
     * Run the plugin event.
     */
    public function run()
    {
        $init = $this->init();
        if ($init !== true) {
            return;
        }

        $this->process();
    }

    /**
     * Initialize the plugin event.
     *
     * @return bool
     */
    public function init()
    {
        return true;
    }

    /**
     * Process the plugin event code.
     *
     * @return mixed
     */
    abstract public function process();
}