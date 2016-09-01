module.exports = function (grunt) {
    // Project configuration.
    grunt.initConfig({
        modx: grunt.file.readJSON('_build/config.json'),
        bump: {
            copyright: {
                files: [{
                    src: 'core/components/pdfresource/model/pdfresource/pdfresource.class.php',
                    dest: 'core/components/pdfresource/model/pdfresource/pdfresource.class.php'
                }],
                options: {
                    replacements: [{
                        pattern: /Copyright 2015(-\d{4})? by/g,
                        replacement: 'Copyright ' + (new Date().getFullYear() > 2015 ? '2015-' : '') + new Date().getFullYear() + ' by'
                    }]
                }
            },
            version: {
                files: [{
                    src: 'core/components/pdfresource/model/pdfresource/pdfresource.class.php',
                    dest: 'core/components/pdfresource/model/pdfresource/pdfresource.class.php'
                }],
                options: {
                    replacements: [{
                        pattern: /version = '\d+.\d+.\d+[-a-z0-9]*'/ig,
                        replacement: 'version = \'' + '<%= modx.version %>' + '\''
                    }]
                }
            }
        }
    });

    //load the packages
    grunt.loadNpmTasks('grunt-string-replace');
    grunt.renameTask('string-replace', 'bump');

    //register the task
    grunt.registerTask('default', ['bump']);
};