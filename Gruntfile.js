module.exports = function (grunt) {
    "use strict";

    var key;
    grunt.initConfig({
        pkg: grunt.file.readJSON( "package.json" ),
        eslint: {
            options: {
                configFile: '.eslintrc.js'
            },
            target: ['view/frontend/web/js/social-share.js']
        }
    });

    // Loading dependencies
    for ( key in grunt.file.readJSON( "package.json" ).devDependencies ) {
        if ( key !== "grunt" && key.indexOf( "grunt" ) === 0 ) {
            grunt.loadNpmTasks( key );
        }
    }

    grunt.registerTask('ci', ['eslint']);
    grunt.registerTask("default", ["ci"]);
};
