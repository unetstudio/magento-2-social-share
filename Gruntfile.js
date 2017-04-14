module.exports = function( grunt ) {
    "use strict";

    var key;
    grunt.initConfig( {
        pkg: grunt.file.readJSON( "package.json" ),
        jshint: {
            options: {
                jshintrc: true
            },
            gruntfile: "Gruntfile.js",
            src: "view/**/*.js"
        },
        jscs: {
            gruntfile: "Gruntfile.js",
            src: "view/**/*.js",
            options: {
                config: ".jscsrc"
            }
        },
        jsonlint: {
            pkg: {
                src: [ "package.json" ]
            }
        }
    } );

    // Loading dependencies
    for ( key in grunt.file.readJSON( "package.json" ).devDependencies ) {
        if ( key !== "grunt" && key.indexOf( "grunt" ) === 0 ) {
            grunt.loadNpmTasks( key );
        }
    }

    grunt.registerTask( "ci", [ "jshint", "jsonlint" ] );
    grunt.registerTask( "default", [ "ci" ] );
};
