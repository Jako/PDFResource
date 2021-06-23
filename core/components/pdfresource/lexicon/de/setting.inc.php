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
$_lang['setting_pdfresource.cssTpl'] = 'PDF style chunk';
$_lang['setting_pdfresource.cssTpl_desc'] = 'Template-Chunk für den PDF-Stil. Sie könnten die @FILE-Bindung verwenden, um den Chunk aus einer Datei abzurufen.';
$_lang['setting_pdfresource.customFonts'] = 'Benutzerdefinierte Schriftarten';
$_lang['setting_pdfresource.customFonts_desc'] = 'JSON-kodiertes Objekt mit benutzerdefinierten Schriftarten, siehe <a href="https://mpdf.github.io/fonts-languages/fonts-in-mpdf-6-x.html#example">Fonts</a> in der mPDF-Dokumentation für das Array-Format. Bitte kopieren Sie die Schriftdateien nach <strong>{core_path}components/pdfresource/vendor/mpdf/mpdf/ttfonts/</strong>.';
$_lang['setting_pdfresource.defaultFont'] = 'PDF default font';
$_lang['setting_pdfresource.defaultFont_desc'] = 'Standardschriftart des erzeugten PDF.';
$_lang['setting_pdfresource.defaultFontSize'] = 'PDF-Standardschriftgröße';
$_lang['setting_pdfresource.defaultFontSize_desc'] = 'Standard-Schriftgröße des erzeugten PDF.';
$_lang['setting_pdfresource.format'] = 'PDF-Seitengröße';
$_lang['setting_pdfresource.format_desc'] = 'Wenn Sie die Ausrichtung einer "benannten" PDF-Seitengröße ändern möchten, müssen Sie -L an den String für die PDF-Seitengröße anhängen (z. B. A4-L).';
$_lang['setting_pdfresource.generateOnPrerender'] = 'PDF beim Prerender erzeugen';
$_lang['setting_pdfresource.generateOnPrerender_desc'] = 'Erzeugen von nicht vorhandene PDF-Dateien beim OnWebPagePrerender Ereignis.';
$_lang['setting_pdfresource.mgb'] = 'PDF-Rand unten';
$_lang['setting_pdfresource.mgb_desc'] = 'Unterer Rand des erzeugten PDF.';
$_lang['setting_pdfresource.mgf'] = 'PDF-Fußzeilenrand';
$_lang['setting_pdfresource.mgf_desc'] = 'Fußzeilenrand des erzeugten PDF.';
$_lang['setting_pdfresource.mgh'] = 'PDF-Kopfzeilenrand';
$_lang['setting_pdfresource.mgh_desc'] = 'Kopfzeilenrand des erzeugten PDF.';
$_lang['setting_pdfresource.mgl'] = 'PDF-Rand links';
$_lang['setting_pdfresource.mgl_desc'] = 'Linker Rand des erzeugten PDF.';
$_lang['setting_pdfresource.mgr'] = 'PDF-Rand rechts';
$_lang['setting_pdfresource.mgr_desc'] = 'Rechter Rand des erzeugten PDF.';
$_lang['setting_pdfresource.mgt'] = 'PDF-Rand oben';
$_lang['setting_pdfresource.mgt_desc'] = 'Oberer Rand des erzeugten PDF.';
$_lang['setting_pdfresource.mode'] = 'mPDF-Modus';
$_lang['setting_pdfresource.mode_desc'] = 'Siehe <a href="https://mpdf.github.io/reference/mpdf-functions/mpdf.html#parameters" target="_blank">Modusparameter</a> und <a href="https://mpdf.github.io/fonts-languages/choosing-a-configuration-v5-x.html" target="_blank">Auswählen einer Konfiguration</a> in der mPDF-Dokumentation für mögliche Werte.';
$_lang['setting_pdfresource.mPDFMethods'] = 'mPDF-Methoden';
$_lang['setting_pdfresource.mPDFMethods_desc'] = 'JSON-kodiertes Array von aufrufbaren mPDF-Methodennamen.';
$_lang['setting_pdfresource.orientation'] = 'PDF orientation';
$_lang['setting_pdfresource.orientation_desc'] = 'Wenn Sie die Ausrichtung einer "benannten" PDF-Seitengröße ändern möchten, müssen Sie -L an den String für die PDF-Seitengröße anhängen (z. B. A4-L).';
$_lang['setting_pdfresource.ownerPassword'] = 'PDF-Besitzer-Passwort';
$_lang['setting_pdfresource.ownerPassword_desc'] = 'Kennwort für den vollen Zugriff und die Berechtigungen auf das erzeugte PDF.';
$_lang['setting_pdfresource.pdfTpl'] = 'PDF content chunk';
$_lang['setting_pdfresource.pdfTpl_desc'] = 'Template-Chunk für den PDF-Inhalt. Sie könnten die @FILE-Bindung verwenden, um den Chunk aus einer Datei abzurufen.';
$_lang['setting_pdfresource.pdfTv'] = 'PDF-Erzeugung TV';
$_lang['setting_pdfresource.pdfTv_desc'] = 'Name der Template-Variable, welche die PDF-Erzeugung aktiviert.';
$_lang['setting_pdfresource.pdfTvLive'] = 'On-the-Fly-PDF-Erzeugung TV';
$_lang['setting_pdfresource.pdfTvLive_desc'] = 'Name der Template-Variable, welche die On-the-Fly-PDF-Erzeugung aktiviert.';
$_lang['setting_pdfresource.pdfTvOptions'] = 'PDF Options TV';
$_lang['setting_pdfresource.pdfTvOptions_desc'] = 'Name der Template-Variable, welche die Optionen des erzeugten PDFs ändert. Der Inhalt dieser Template-Variable muss ein JSON-kodiertes Objekt der Optionen enthalten, die Sie ändern möchten.';
$_lang['setting_pdfresource.permissions'] = 'PDF-Berechtigungen';
$_lang['setting_pdfresource.permissions_desc'] = 'JSON-kodiertes Array von Berechtigungen, die dem Endbenutzer der PDF-Datei gewährt werden. Siehe <a href="https://mpdf.github.io/reference/mpdf-functions/setprotection.html#parameters">Berechtigungen</a> in der mPDF-Dokumentation für mögliche Werte.';
$_lang['setting_pdfresource.processTVs'] = 'Process template variables';
$_lang['setting_pdfresource.processTVs_desc'] = 'Template-Variablen bei der PDF-Erzeugung verarbeiten.';
$_lang['setting_pdfresource.tvPrefix'] = 'Template variable prefix';
$_lang['setting_pdfresource.tvPrefix_desc'] = 'Template-Variablen-Präfix für die Platzhalter im PDF-Inhalt-Chunk.';
$_lang['setting_pdfresource.userPassword'] = 'PDF User Password';
$_lang['setting_pdfresource.userPassword_desc'] = 'Kennwort, das zum Öffnen des erzeugten PDF erforderlich ist.';
