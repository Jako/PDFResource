# Usage

*PDFresource* works out of the box and creates PDF files from all resources, that have the template variable `create_pdf` assigned (the template variable name could be changed in MODX system settings). The generated PDF files are saved with the current alias path to `{assets_url}/pdf/`

So after the installation you only have to assign the template variable `create_pdf` to the templates of the resources that should be converted to PDF and check that template variable in the resource (checked by default).

### PDF options

By default the PDF content and the CSS code for the PDF could be changed with the chunks `tplPDF` and `tplCSS`. Some other PDF options (pagesize, margins etc.) could be set in MODX system setting.

The following MODX system settings are available in the namespace `pdfresource`:

Key | Description
----|------------
pdfresource.mode | mPDF mode, see [mode parameter](http://mpdf1.com/manual/index.php?tid=184) and [choosing a configuration](http://mpdf1.com/manual/index.php?tid=504) in the mPDF documentation for possible values.
pdfresource.format | PDF page size. If you want to change the orientation of a "named" PDF page size you have to append -L to the PDF page size string (i.e. A4-L).
pdfresource.defaultFontSize | PDF default font size
pdfresource.defaultFont | PDF default font
pdfresource.mgl | PDF margin left
pdfresource.mgr | PDF margin right 
pdfresource.mgt | PDF margin top 
pdfresource.mgb | PDF margin bottom 
pdfresource.mgh | PDF margin header
pdfresource.mgf | PDF margin footer
pdfresource.orientation | PDF orientation. If you want to change the orientation of a "named" PDF page size you have to append -L to the PDF page size string (i.e. A4-L).
pdfresource.pdfTpl | Template chunk for the PDF content. You could use @FILE binding to retreive the chunk from a file.
pdfresource.cssTpl | Template chunk for the PDF style. You could use @FILE binding to retreive the chunk from a file.
pdfresource.pdfTv | Name ot the template variable that activates the PDF generation.
pdfresource.pdfTvTpl | Name of the template variable that change the options of the generated PDF. The content of this template variable has to contain a JSON encoded object of the options you want to change.
pdfresource.processTVs | Process template variables during PDF generation.
pdfresource.tvPrefix | Template variable prefix in the template chunk.

The following MODX system settings have to be created to use them:

Key | Description
----|------------
pdfresource.creator | Author of the PDF file (defaults to `site_name` system setting).
pdfresource.author | Creator of the PDF file (defaults to `site_url` system setting + ` powered by PDFresource/mPDF`).

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

The content of the PDF is filled with the chunk defined by `pdfresource.pdfTpl` MODX system setting (or on resource base by the `pdf_options` template variable). By default PDFresource uses the `tplPDF` chunk. You could fill this chunk like a normal MODX template with resource placeholders, snippet calls etc. Since the PDF is not created on the fly, the content is fixed after saving the resource.

### PDF styles template

The style of the PDF is set with the chunk defined by `pdfresource.cssTpl` MODX system setting (or on resource base by the `pdf_options` template variable). By default PDFresource uses the `tplCSS` chunk. There are some limitations with mPDF and CSS (i.e. `position: absolute` works only with elements on root level).

### Linking to a generated PDF

All generated PDF files are saved with the aliaspath of the generating resource. So if you want to create a link to that PDF file, you could use the following code:

```
<a href="/assets/pdf/[[~[[*parent]]]][[*alias]].pdf">PDF</a>
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
