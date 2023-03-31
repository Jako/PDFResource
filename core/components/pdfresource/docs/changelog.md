# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.1] - 2022-03-28

### Fixed

- Fix removing the container suffix, when it is not a slash [#38]

## [2.0.0] - 2022-03-28

### Added

- Add pdfresource.customFontsFolder system setting for custom fonts folder
- Add empty pdfresource.author system setting to make manual creation unnecessary
- Add empty pdfresource.creator system setting to make manual creation unnecessary

### Changed

- Install the Composer dependencies directly on the server (semantic major version change because of the custom fonts location)

### Fixed

- Bugfix for default font is always 'dejavusanscondensed' when using custom fonts [#15]

## [1.6.0] - 2022-01-27

### Added

- Debug output of the html/css before it is handled by mPDF

### Changed

- Code refactoring
- Full MODX 3 compatibility
- Update mPDF to 8.0.17

### Fixed

- Prevent an error, when $modx->resource is not set

## [1.5.10] - 2019-10-20

### Fixed

- Bugfix for saving the PDF with an empty parent resource path

## [1.5.9] - 2019-09-20

### Fixed

- Bugfix for creating the parent alias with a not default container_suffix system setting

## [1.5.8] - 2019-06-07

### Changed

- Update mPDF to 6.1.4

## [1.5.7] - 2017-12-05

### Changed

- GPM options for empty temporary vendor folders

### Fixed

- Bugfix for creating temporary vendor folders
- Bugfix for allowed memory size exhausted

## [1.5.6] - 2017-09-18

### Fixed

- Bugfix for creating folders recursive

## [1.5.5] - 2016-10-14

### Fixed

- Bugfix for PHP version specific issues

## [1.5.4] - 2016-08-15

### Changed

- Change mPDF documentation links to https://mpdf.github.io/

## [1.5.3] - 2016-08-15

### Changed

- Update mPDF to 1.6.1

## [1.5.2] - 2016-04-16

### Fixed

- Bugfix for wrong PDF margin header

## [1.5.1] - 2016-03-15

### Fixed

- Bugfix for resource based PDF options

## [1.5.0] - 2015-11-27

### Added

- Set all mPDF options by calling mPDF class methods with callbacks

### Changed

- Improved error logging

## [1.4.0] - 2015-11-07

### Added

- PDF password protection

## [1.3.0] - 2015-11-05

### Added

- Create PDF files on the fly by assigning and checking the template variable live_pdf

## [1.2.3] - 2015-11-04

### Fixed

- Bugfix for create_pdf template variable is assigned to the template

## [1.2.2] - 2015-11-04

### Added

- pdfresource.generateOnPrerender system setting

### Changed

- Load mPDF/modPDF class only if needed for less memory usage

## [1.2.1] - 2015-11-04

### Added

- Check if the create_pdf template variable is assigned to the template

### Changed

- Modified alias path generation

## [1.2.0] - 2015-11-01

### Added

- Add custom fonts by pdfresource.customFonts system setting

## [1.1.0] - 2015-10-28

### Added

- Create not existing PDF files during OnWebPagePrerender
- Initial release for MODX Revolution
