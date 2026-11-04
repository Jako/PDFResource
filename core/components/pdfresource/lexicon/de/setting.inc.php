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
$_lang['setting_pdfresource.author'] = 'PDF-Autor';
$_lang['setting_pdfresource.author_desc'] = 'Autor der PDF-Datei.';
$_lang['setting_pdfresource.creator'] = 'PDF-Ersteller';
$_lang['setting_pdfresource.creator_desc'] = 'Ersteller der PDF-Datei.';
$_lang['setting_pdfresource.cssTpl'] = 'PDF-Style-Chunk';
$_lang['setting_pdfresource.cssTpl_desc'] = 'Template-Chunk für den PDF-Style. Sie könnten die @FILE-Bindung verwenden, um den Chunk aus einer Datei abzurufen.';
$_lang['setting_pdfresource.customFonts'] = 'Benutzerdefinierte Schriftarten';
$_lang['setting_pdfresource.customFonts_desc'] = 'JSON-kodiertes Objekt mit benutzerdefinierten Schriftarten, siehe <a href="https://mpdf.github.io/fonts-languages/fonts-in-mpdf-7-x.html#example">Fonts</a> in der mPDF-Dokumentation für das Array-Format. Bitte kopieren Sie die Schriftdateien in den Ordner, auf den in der Systemeinstellung <strong>pdfresource.customFontsFolder</strong> verwiesen wird.';
$_lang['setting_pdfresource.customFontsFolder'] = 'Ordner für benutzerdefinierte Schriftarten';
$_lang['setting_pdfresource.customFontsFolder_desc'] = 'Pfad zum Ordner für benutzerdefinierte Schriftarten. Wenn der Pfad nicht gesetzt oder nicht verfügbar ist, wird `pdfresource.customFonts` nicht verwendet. Die Platzhalter {core_path}, {base_path} und {assets_path} können in dieser Einstellung benutzt werden.';
$_lang['setting_pdfresource.debug'] = 'Debug';
$_lang['setting_pdfresource.debug_desc'] = 'Debug-Informationen im MODX-Fehlerprotokoll ausgeben.';
$_lang['setting_pdfresource.defaultFont'] = 'PDF-Standardschriftart';
$_lang['setting_pdfresource.defaultFont_desc'] = 'Standardschriftart des erzeugten PDFs.';
$_lang['setting_pdfresource.defaultFontSize'] = 'PDF-Standard-Schriftgröße';
$_lang['setting_pdfresource.defaultFontSize_desc'] = 'Standard-Schriftgröße des erzeugten PDFs.';
$_lang['setting_pdfresource.footerTpl'] = 'PDF-Fußzeilen-Chunk';
$_lang['setting_pdfresource.footerTpl_desc'] = 'Template-Chunk für die HTML-Fußzeile auf jeder PDF-Seite. Sie könnten die @FILE-Bindung verwenden, um den Chunk aus einer Datei abzurufen. Die mPDF-Platzhalter {PAGENO} und {nbpg} können im Chunk verwendet werden.';
$_lang['setting_pdfresource.format'] = 'PDF-Seitengröße';
$_lang['setting_pdfresource.format_desc'] = 'Wenn Sie die Ausrichtung einer "benannten" PDF-Seitengröße ändern möchten, müssen Sie -L an den String für die PDF-Seitengröße anhängen (z. B. A4-L).';
$_lang['setting_pdfresource.generateOnPrerender'] = 'PDF beim Prerender erzeugen';
$_lang['setting_pdfresource.generateOnPrerender_desc'] = 'Nicht vorhandene PDF-Dateien zusätzlich beim OnWebPagePrerender-Ereignis erzeugen.';
$_lang['setting_pdfresource.headerTpl'] = 'PDF-Kopfzeilen-Chunk';
$_lang['setting_pdfresource.headerTpl_desc'] = 'Template-Chunk für die HTML-Kopfzeile auf jeder PDF-Seite. Sie könnten die @FILE-Bindung verwenden, um den Chunk aus einer Datei abzurufen. Die mPDF-Platzhalter {PAGENO} und {nbpg} können im Chunk verwendet werden.';
$_lang['setting_pdfresource.mgb'] = 'PDF-Rand unten';
$_lang['setting_pdfresource.mgb_desc'] = 'Unterer Rand des erzeugten PDFs.';
$_lang['setting_pdfresource.mgf'] = 'PDF-Fußzeilenrand';
$_lang['setting_pdfresource.mgf_desc'] = 'Fußzeilenrand des erzeugten PDFs.';
$_lang['setting_pdfresource.mgh'] = 'PDF-Kopfzeilenrand';
$_lang['setting_pdfresource.mgh_desc'] = 'Kopfzeilenrand des erzeugten PDFs.';
$_lang['setting_pdfresource.mgl'] = 'PDF-Rand links';
$_lang['setting_pdfresource.mgl_desc'] = 'Linker Rand des erzeugten PDFs.';
$_lang['setting_pdfresource.mgr'] = 'PDF-Rand rechts';
$_lang['setting_pdfresource.mgr_desc'] = 'Rechter Rand des erzeugten PDFs.';
$_lang['setting_pdfresource.mgt'] = 'PDF-Rand oben';
$_lang['setting_pdfresource.mgt_desc'] = 'Oberer Rand des erzeugten PDFs.';
$_lang['setting_pdfresource.mode'] = 'mPDF-Modus';
$_lang['setting_pdfresource.mode_desc'] = 'Siehe <a href="https://mpdf.github.io/reference/mpdf-functions/mpdf.html#parameters" target="_blank">Modusparameter</a> und <a href="https://mpdf.github.io/fonts-languages/choosing-a-configuration-v5-x.html" target="_blank">Auswählen einer Konfiguration</a> in der mPDF-Dokumentation für mögliche Werte.';
$_lang['setting_pdfresource.mPDFMethods'] = 'mPDF-Methoden';
$_lang['setting_pdfresource.mPDFMethods_desc'] = 'JSON-kodiertes Array von aufrufbaren mPDF-Methodennamen.';
$_lang['setting_pdfresource.orientation'] = 'PDF-Ausrichtung';
$_lang['setting_pdfresource.orientation_desc'] = 'Wenn Sie die Ausrichtung einer "benannten" PDF-Seitengröße ändern möchten, müssen Sie -L an den String für die PDF-Seitengröße anhängen (z. B. A4-L).';
$_lang['setting_pdfresource.ownerPassword'] = 'PDF-Besitzer-Passwort';
$_lang['setting_pdfresource.ownerPassword_desc'] = 'Passwort für den vollen Zugriff und die Berechtigungen auf das erzeugte PDF.';
$_lang['setting_pdfresource.pdfTpl'] = 'PDF-Inhalt-Chunk';
$_lang['setting_pdfresource.pdfTpl_desc'] = 'Template-Chunk für den PDF-Inhalt. Sie könnten die @FILE-Bindung verwenden, um den Chunk aus einer Datei abzurufen.';
$_lang['setting_pdfresource.pdfTv'] = 'PDF-Erzeugung TV';
$_lang['setting_pdfresource.pdfTv_desc'] = 'Name der Template-Variable, welche die PDF-Erzeugung aktiviert.';
$_lang['setting_pdfresource.pdfTvLive'] = 'On-the-Fly-PDF-Erzeugung TV';
$_lang['setting_pdfresource.pdfTvLive_desc'] = 'Name der Template-Variable, welche die On-the-Fly-PDF-Erzeugung aktiviert.';
$_lang['setting_pdfresource.pdfTvOptions'] = 'PDF-Optionen TV';
$_lang['setting_pdfresource.pdfTvOptions_desc'] = 'Name der Template-Variable, welche die Optionen des erzeugten PDFs ändert. Der Inhalt dieser Template-Variable muss ein JSON-kodiertes Objekt der Optionen enthalten, die Sie ändern möchten.';
$_lang['setting_pdfresource.permissions'] = 'PDF-Berechtigungen';
$_lang['setting_pdfresource.permissions_desc'] = 'JSON-kodiertes Array von Berechtigungen, die dem Endbenutzer der PDF-Datei gewährt werden. Siehe <a href="https://mpdf.github.io/reference/mpdf-functions/setprotection.html#parameters">Berechtigungen</a> in der mPDF-Dokumentation für mögliche Werte.';
$_lang['setting_pdfresource.processTVs'] = 'Template-Variablen verarbeiten';
$_lang['setting_pdfresource.processTVs_desc'] = 'Template-Variablen bei der PDF-Erzeugung verarbeiten.';
$_lang['setting_pdfresource.tvPrefix'] = 'Template-Variablen-Präfix';
$_lang['setting_pdfresource.tvPrefix_desc'] = 'Template-Variablen-Präfix für die Platzhalter im PDF-Inhalt-Chunk.';
$_lang['setting_pdfresource.userPassword'] = 'PDF-Benutzer-Passwort';
$_lang['setting_pdfresource.userPassword_desc'] = 'Passwort, das zum Öffnen des erzeugten PDFs erforderlich ist.';
