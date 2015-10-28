# Usage

*PDFresource* works out of the box and creates PDF files from all resources, that have the template variable `create_pdf` assigned (the template variable name could be changed in MODX system settings). The generated PDF files are saved with the current alias path to `{assets_url}/pdf/`

### PDF options

By default the PDF content and the CSS code for the PDF could be changed with in the chunks tplPDF and tplCSS. Some other PDF settings (pagesize, margins etc.) could be changed in MODX system setting.

The following settings could be set in MODX system settings:

Key | Description
----|------------
pdfresource.mode | mPDF mode, see [mPDF documentation](http://mpdf1.com/manual/)
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

All these options could be changed on resource base in a template variable `pdf_options` (the template variable name could be changed in MODX system settings). This template variable has to contain an JSON encoded object of options without the prefix `pdfresource.`.

```
{
    "format": "A4-L",
    "mgl": 20,
    "mgr": 20
}
```

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//piwik.partout.info/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 9999]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//piwik.partout.info/piwik.php?idsite=9999" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
