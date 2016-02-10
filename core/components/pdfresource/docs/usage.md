# Usage

*PDFResource* works out of the box and creates PDF files from all resources, that have the template variable `create_pdf` assigned (the template variable name could be changed in MODX system settings). The generated PDF files are saved with the current alias path to `{assets_url}/pdf/`

So after the installation you only have to assign the template variable `create_pdf` to the templates of the resources that should be converted to PDF and check that template variable in the resource (checked by default).

### PDF generation on the fly

To generate PDF files on the fly with *PDFResource* you have to assign the template variable `live_pdf` to a template (the template variable name could be changed in MODX system settings) and check this template variable on a resource. After this, the resource will be rendered as PDF file in the browser. The file could be saved with the current alias.
 
**Caution:** This option should only be activated, if the content of the resource is dynamically changed. Generating the PDF is a quite resource consuming process and it could take some time.

### PDF options

By default the PDF content and the CSS code for the PDF could be changed with the chunks `tplPDF` and `tplCSS`. Some other PDF options (pagesize, margins etc.) could be set in MODX system setting.

The following MODX system settings are available in the namespace `pdfresource`:

Key | Description | Default
----|-------------|--------
pdfresource.mode | mPDF mode, see [mode parameter](http://mpdf1.com/manual/index.php?tid=184) and [choosing a configuration](http://mpdf1.com/manual/index.php?tid=504) in the mPDF documentation for possible values. | -
pdfresource.format | PDF page size. If you want to change the orientation of a "named" PDF page size you have to append -L to the PDF page size string (i.e. A4-L). | A4
pdfresource.defaultFontSize | PDF default font size | 0
pdfresource.defaultFont | PDF default font | -
pdfresource.mgl | PDF margin left | 15
pdfresource.mgr | PDF margin right | 15
pdfresource.mgt | PDF margin top | 16
pdfresource.mgb | PDF margin bottom | 16
pdfresource.mgh | PDF margin header | 9
pdfresource.mgf | PDF margin footer | 9
pdfresource.orientation | PDF orientation. If you want to change the orientation of a "named" PDF page size you have to append -L to the PDF page size string (i.e. A4-L). | P
pdfresource.pdfTpl | Template chunk for the PDF content. You could use @FILE binding to retreive the chunk from a file. | tplPDF
pdfresource.cssTpl | Template chunk for the PDF style. You could use @FILE binding to retreive the chunk from a file. | tplCSS
pdfresource.pdfTv | Name ot the template variable that activates the PDF generation. | create_pdf
pdfresource.pdfTvLive | Name of the template variable that activates the on the fly PDF generation. | live_pdf
pdfresource.pdfTvOptions | Name of the template variable that change the options of the generated PDF. The content of this template variable has to contain a JSON encoded object of the options you want to change. | pdf_options
pdfresource.processTVs | Process template variables during PDF generation. | true
pdfresource.tvPrefix | Template variable prefix in the template chunk. | .tv
pdfresource.customFonts | JSON encoded object of custom fonts, see [Custom fonts](#custom-fonts) for an example. Please copy the font files to **{core_path}components/pdfresource/vendor/mpdf/mpdf/ttfonts/**. | -
pdfresource.generateOnPrerender | Generate not existing PDF files during OnWebPagePrerender. This option is useful, if you have installed PDFResource in an existing MODX installation. You don't have to save all resources that could generate a PDF file then. | false
pdfresource.permissions | JSON encoded array of permissions granted to the end-user of the PDF file. See [permissions](http://mpdf1.com/manual/index.php?tid=129) in the mPDF documentation for possible values. | []
pdfresource.userPassword | Password required to open the generated PDF. | -
pdfresource.ownerPassword | Password for full access and permissions to the generated PDF. | -
pdfresource.mPDFMethods | JSON encoded array of callable mPDF method names. | []

The following MODX system settings have to be created to use them:

Key | Description | Default
----|-------------|--------
pdfresource.author | Author of the PDF file | `site_name` system setting
pdfresource.creator | Creator of the PDF file | `site_url` system setting + ` powered by PDFResource/mPDF`

### Resource based PDF options

All these options could be modified on resource base in a template variable `pdf_options` (the template variable name could be changed in MODX system settings). This template variable has to contain an JSON encoded object of options without the prefix `pdfresource.`.

#### Example

```
{
    "format": "A4-L",
    "mgl": 20,
    "mgr": 20
}
```

### PDF content template

The content of the PDF is filled with the chunk defined by `pdfresource.pdfTpl` MODX system setting (or on resource base by the `pdf_options` template variable). By default PDFResource uses the `tplPDF` chunk. You could fill this chunk like a normal MODX template with resource placeholders, snippet calls etc. Since the PDF is not created on the fly, the content is fixed after saving the resource.

### PDF styles template

The style of the PDF is set with the chunk defined by `pdfresource.cssTpl` MODX system setting (or on resource base by the `pdf_options` template variable). By default PDFResource uses the `tplCSS` chunk. There are some limitations with mPDF and CSS (i.e. `position: absolute` works only with elements on root level).

### Custom fonts

To use custom fonts in your PDF files, you have to add them as JSON encoded object in the MODX system setting `pdfresource.customFonts`. See [Fonts](http://mpdf1.com/manual/index.php?tid=501) in the mPDF documentation a the full description. 

#### Example

```
{
  "frutiger": {
    "R": "Frutiger-Normal.ttf",
    "I": "FrutigerObl-Normal.ttf"
  }
}
```

Please copy the font files to **{core_path}components/pdfresource/vendor/mpdf/mpdf/ttfonts/**.

### PDF permissions

The generated PDF could be encrypted to set user permissions. An user password to open the file and an owner password to bypass and/or change the permission restrictions could be set. The PDF encryption is enabled if the user or the owner password is set. 

A list of permissions could be found at [permissions](http://mpdf1.com/manual/index.php?tid=129) in the mPDF documentation. By default all permissions are denied if the file is encrypted. 

The following example JSON will grant copying and printing (low-res) to the end-user of the generated PDF.

#### Example

```
["copy", "print"]
```

### Other mPDF options

If you want to set other mPDF options to modify the PDF file creation, you could call the [mPDF class methods](http://mpdf1.com/manual/index.php?tid=184) with callbacks.

To use the callbacs, you first have to fill the MODX system setting `pdfresource.mPDFMethods` with an JSON encoded array of called method names. After that, you have to fill the according MODX system setting or (on resource base) an according key in `pdf_options` template variable. The method parameters have to be set by an JSON encoded array.

#### Example

To call the mPDF method `SetHTMLFooter` you have to set the MODX system setting `pdfresource.mPDFMethods` to

```
["SetHTMLFooter"]
```

After that you have to create a MODX system setting `pdfresource.SetHTMLFooter` and fill it with

```
["<div align='right' style='font-size: 8pt;'>{PAGENO}</div><div align='center' style='font-size: 8pt; font-style: italic;'><hr>My footer text.</div>"]
```

or fill the `PDF Options` template variable of a resource with

```
{
  "SetHTMLFooter": [
    "<div align='right' style='font-size: 8pt;'>{PAGENO}</div><div align='center' style='font-size: 8pt; font-style: italic;'><hr>My footer text.</div>"
  ]
}
```


### Linking to a generated PDF

All generated static PDF files are saved with the aliaspath of the generating resource. If you want to create a link to that PDF file, you could use the following code:

```
<a href="[[*id:pdfresourcelink]]">PDF</a>
```

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//piwik.partout.info/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 18]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//piwik.partout.info/piwik.php?idsite=18" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
