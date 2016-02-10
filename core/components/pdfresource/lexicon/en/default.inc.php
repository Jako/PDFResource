<?php
/**
 * Default English Lexicon Entries for PDFresouce
 *
 * @package pdfresource
 * @subpackage lexicon
 */
$_lang['pdfresource'] = 'PDFResource';
$_lang['area_pdf'] = 'PDF';
$_lang['area_resource'] = 'Resource';
$_lang['area_template'] = 'Template';

$_lang['setting_pdfresource.mode'] = 'mPDF mode';
$_lang['setting_pdfresource.mode_desc'] = 'See <a href="http://mpdf1.com/manual/index.php?tid=184" target="_blank">mode parameter</a> and <a href="http://mpdf1.com/manual/index.php?tid=504" target="_blank">choosing a configuration</a> in the mPDF documentation for possible values.';
$_lang['setting_pdfresource.format'] = 'PDF page size';
$_lang['setting_pdfresource.format_desc'] = 'If you want to change the orientation of a "named" PDF page size you have to append -L to the PDF page size string (i.e. A4-L)';
$_lang['setting_pdfresource.defaultFontSize'] = 'PDF default font size';
$_lang['setting_pdfresource.defaultFont'] = 'PDF default font';
$_lang['setting_pdfresource.mgl'] = 'PDF margin left';
$_lang['setting_pdfresource.mgr'] = 'PDF margin right';
$_lang['setting_pdfresource.mgt'] = 'PDF margin top';
$_lang['setting_pdfresource.mgb'] = 'PDF margin bottom';
$_lang['setting_pdfresource.mgh'] = 'PDF margin header';
$_lang['setting_pdfresource.mgf'] = 'PDF margin footer';
$_lang['setting_pdfresource.orientation'] = 'PDF orientation';
$_lang['setting_pdfresource.orientation_desc'] = 'If you want to change the orientation of a "named" PDF page size you have to append -L to the PDF page size string (i.e. A4-L)';
$_lang['setting_pdfresource.pdfTpl'] = 'PDF content chunk';
$_lang['setting_pdfresource.pdfTpl_desc'] = 'Template chunk for the PDF content. You could use @FILE binding to retreive the chunk from a file.';
$_lang['setting_pdfresource.cssTpl'] = 'PDF style chunk';
$_lang['setting_pdfresource.cssTpl_desc'] = 'Template chunk for the PDF style. You could use @FILE binding to retreive the chunk from a file.';
$_lang['setting_pdfresource.pdfTv'] = 'Generate PDF TV';
$_lang['setting_pdfresource.pdfTv_desc'] = 'Name ot the template variable that activates the PDF generation.';
$_lang['setting_pdfresource.pdfTvLive'] = 'Generate On The Fly TV';
$_lang['setting_pdfresource.pdfTvLive_desc'] = 'Name ot the template variable that activates the on the fly PDF generation.';
$_lang['setting_pdfresource.pdfTvOptions'] = 'PDF Options TV';
$_lang['setting_pdfresource.pdfTvOptions_desc'] = 'Name of the template variable that change the options of the generated PDF. The content of this template variable has to contain a JSON encoded object of the options you want to change';
$_lang['setting_pdfresource.processTVs'] = 'Process template variables';
$_lang['setting_pdfresource.processTVs_desc'] = 'Process template variables during PDF generation.';
$_lang['setting_pdfresource.tvPrefix'] = 'Template variable prefix';
$_lang['setting_pdfresource.tvPrefix_desc'] = 'Template variable prefix for the placeholders in the PDF content chunk.';
$_lang['setting_pdfresource.customFonts'] = 'Custom Fonts';
$_lang['setting_pdfresource.customFonts_desc'] = 'JSON encoded object of custom fonts, see <a href="http://mpdf1.com/manual/index.php?tid=501">Fonts</a> in the mPDF documentation for the array format. Please copy the font files to <strong>{core_path}components/pdfresource/vendor/mpdf/mpdf/ttfonts/</strong>.';
$_lang['setting_pdfresource.generateOnPrerender'] = 'Generate PDF on prerender';
$_lang['setting_pdfresource.generateOnPrerender_desc'] = 'Generate not existing PDF files during OnWebPagePrerender too.';
$_lang['setting_pdfresource.permissions'] = 'PDF Permissions';
$_lang['setting_pdfresource.permissions_desc'] = 'JSON encoded array of permissions granted to the end-user of the PDF file. see <a href="http://mpdf1.com/manual/index.php?tid=129">permissions</a> in the mPDF documentation for possible values.';
$_lang['setting_pdfresource.userPassword'] = 'PDF User Password';
$_lang['setting_pdfresource.permissions_desc'] = 'Password required to open the generated PDF.';
$_lang['setting_pdfresource.ownerPassword'] = 'PDF Owner Password';
$_lang['setting_pdfresource.permissions_desc'] = 'Password for full access and permissions to the generated PDF.';
