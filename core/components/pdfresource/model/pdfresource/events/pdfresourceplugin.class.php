<?php
/**
 * @package pdfresource
 * @subpackage plugin
 */

abstract class PDFResourcePlugin
{
    /** @var modX $modx */
    protected $modx;
    /** @var PDFResource $pdfresource */
    protected $pdfresource;
    /** @var array $scriptProperties */
    protected $scriptProperties;

    public function __construct($modx, &$scriptProperties)
    {
        $this->scriptProperties =& $scriptProperties;
        $this->modx =& $modx;
        $corePath = $this->modx->getOption('pdfresource.core_path', null, $this->modx->getOption('core_path') . 'components/pdfresource/');
        $this->pdfresource = $this->modx->getService('pdfresource', 'PDFResource', $corePath . 'model/pdfresource/', array(
            'core_path' => $corePath
        ));
    }

    abstract public function run();
}