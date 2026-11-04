<?php
/**
 * Setting Lexicon Entries for PDFResource
 *
 * @package pdfresource
 * @subpackage lexicon
 */
$_lang['area_pdf'] = 'PDF';
$_lang['area_resource'] = 'Resource';
$_lang['area_template'] = 'Template';
$_lang['setting_pdfresource.author'] = 'PDF author';
$_lang['setting_pdfresource.author_desc'] = 'Author of the PDF file.';
$_lang['setting_pdfresource.creator'] = 'PDF creator';
$_lang['setting_pdfresource.creator_desc'] = 'Creator of the PDF file.';
$_lang['setting_pdfresource.cssTpl'] = 'PDF style chunk';
$_lang['setting_pdfresource.cssTpl_desc'] = 'Template chunk for the PDF style. You could use @FILE binding to retrieve the chunk from a file.';
$_lang['setting_pdfresource.customFonts'] = 'Custom fonts';
$_lang['setting_pdfresource.customFonts_desc'] = 'JSON-encoded object of custom fonts, see <a href="https://mpdf.github.io/fonts-languages/fonts-in-mpdf-7-x.html#example">Fonts</a> in the mPDF documentation for the array format. Please copy the font files to the folder referenced in the <strong>pdfresource.customFontsFolder</strong> system setting.';
$_lang['setting_pdfresource.customFontsFolder'] = 'Custom fonts folder';
$_lang['setting_pdfresource.customFontsFolder_desc'] = 'Path to the custom fonts folder. If the path is not set or available, `pdfresource.customFonts` is not used. The {core_path}, {base_path} and {assets_path} placeholders can be used in this setting.';
$_lang['setting_pdfresource.debug'] = 'Debug';
$_lang['setting_pdfresource.debug_desc'] = 'Log debug information in the MODX error log.';
$_lang['setting_pdfresource.defaultFont'] = 'PDF default font';
$_lang['setting_pdfresource.defaultFont_desc'] = 'Default font of the generated PDF.';
$_lang['setting_pdfresource.defaultFontSize'] = 'PDF default font size';
$_lang['setting_pdfresource.defaultFontSize_desc'] = 'Default font size of the generated PDF.';
$_lang['setting_pdfresource.footerTpl'] = 'PDF footer chunk';
$_lang['setting_pdfresource.footerTpl_desc'] = 'Template chunk for the HTML footer on each PDF page. You could use @FILE binding to retrieve the chunk from a file. The mPDF placeholders {PAGENO} and {nbpg} can be used in the chunk.';
$_lang['setting_pdfresource.format'] = 'PDF page size';
$_lang['setting_pdfresource.format_desc'] = 'If you want to change the orientation of a "named" PDF page size you have to append -L to the PDF page size string (e.g. A4-L).';
$_lang['setting_pdfresource.generateOnPrerender'] = 'Generate PDF on prerender';
$_lang['setting_pdfresource.generateOnPrerender_desc'] = 'Generate missing PDF files during OnWebPagePrerender too.';
$_lang['setting_pdfresource.headerTpl'] = 'PDF header chunk';
$_lang['setting_pdfresource.headerTpl_desc'] = 'Template chunk for the HTML header on each PDF page. You could use @FILE binding to retrieve the chunk from a file. The mPDF placeholders {PAGENO} and {nbpg} can be used in the chunk.';
$_lang['setting_pdfresource.mgb'] = 'PDF margin bottom';
$_lang['setting_pdfresource.mgb_desc'] = 'Bottom margin of the generated PDF.';
$_lang['setting_pdfresource.mgf'] = 'PDF margin footer';
$_lang['setting_pdfresource.mgf_desc'] = 'Footer margin of the generated PDF.';
$_lang['setting_pdfresource.mgh'] = 'PDF margin header';
$_lang['setting_pdfresource.mgh_desc'] = 'Header margin of the generated PDF.';
$_lang['setting_pdfresource.mgl'] = 'PDF margin left';
$_lang['setting_pdfresource.mgl_desc'] = 'Left margin of the generated PDF.';
$_lang['setting_pdfresource.mgr'] = 'PDF margin right';
$_lang['setting_pdfresource.mgr_desc'] = 'Right margin of the generated PDF.';
$_lang['setting_pdfresource.mgt'] = 'PDF margin top';
$_lang['setting_pdfresource.mgt_desc'] = 'Top margin of the generated PDF.';
$_lang['setting_pdfresource.mode'] = 'mPDF mode';
$_lang['setting_pdfresource.mode_desc'] = 'See <a href="https://mpdf.github.io/reference/mpdf-functions/mpdf.html#parameters" target="_blank">mode parameter</a> and <a href="https://mpdf.github.io/fonts-languages/choosing-a-configuration-v5-x.html" target="_blank">choosing a configuration</a> in the mPDF documentation for possible values.';
$_lang['setting_pdfresource.mPDFMethods'] = 'mPDF methods';
$_lang['setting_pdfresource.mPDFMethods_desc'] = 'JSON-encoded array of callable mPDF method names.';
$_lang['setting_pdfresource.orientation'] = 'PDF orientation';
$_lang['setting_pdfresource.orientation_desc'] = 'If you want to change the orientation of a "named" PDF page size you have to append -L to the PDF page size string (e.g. A4-L).';
$_lang['setting_pdfresource.ownerPassword'] = 'PDF owner password';
$_lang['setting_pdfresource.ownerPassword_desc'] = 'Password for full access and permissions to the generated PDF.';
$_lang['setting_pdfresource.pdfTpl'] = 'PDF content chunk';
$_lang['setting_pdfresource.pdfTpl_desc'] = 'Template chunk for the PDF content. You could use @FILE binding to retrieve the chunk from a file.';
$_lang['setting_pdfresource.pdfTv'] = 'Generate PDF TV';
$_lang['setting_pdfresource.pdfTv_desc'] = 'Name of the template variable that activates the PDF generation.';
$_lang['setting_pdfresource.pdfTvLive'] = 'Generate on the fly TV';
$_lang['setting_pdfresource.pdfTvLive_desc'] = 'Name of the template variable that activates the on the fly PDF generation.';
$_lang['setting_pdfresource.pdfTvOptions'] = 'PDF options TV';
$_lang['setting_pdfresource.pdfTvOptions_desc'] = 'Name of the template variable that changes the options of the generated PDF. The content of this template variable has to contain a JSON-encoded object of the options you want to change.';
$_lang['setting_pdfresource.permissions'] = 'PDF permissions';
$_lang['setting_pdfresource.permissions_desc'] = 'JSON-encoded array of permissions granted to the end-user of the PDF file. See <a href="https://mpdf.github.io/reference/mpdf-functions/setprotection.html#parameters">permissions</a> in the mPDF documentation for possible values.';
$_lang['setting_pdfresource.processTVs'] = 'Process template variables';
$_lang['setting_pdfresource.processTVs_desc'] = 'Process template variables during PDF generation.';
$_lang['setting_pdfresource.tvPrefix'] = 'Template variable prefix';
$_lang['setting_pdfresource.tvPrefix_desc'] = 'Template variable prefix for the placeholders in the PDF content chunk.';
$_lang['setting_pdfresource.userPassword'] = 'PDF user password';
$_lang['setting_pdfresource.userPassword_desc'] = 'Password required to open the generated PDF.';
