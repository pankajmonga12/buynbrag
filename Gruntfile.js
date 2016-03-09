'use strict';
var lrSnippet = require('grunt-contrib-livereload/lib/utils').livereloadSnippet;
var mountFolder = function (connect, dir) {
    return connect.static(require('path').resolve(dir));
};

module.exports = function (grunt) {
    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').concat(['gruntacular']).forEach(grunt.loadNpmTasks);

//    var siteMap = grunt.file.read("./sitemap.xml");
//    grunt.file.write("./manish.txt", siteMap);

    // configurable paths
    var yeomanConfig = {
        app: 'application/views/app',
        dist: 'application/views/dist'
    };

    try {
        yeomanConfig.app = require('./component.json').appPath || yeomanConfig.app;
    } catch (e) {}

    grunt.initConfig({
        yeoman: yeomanConfig,
        watch: {
//            coffee: {
//                files: ['<%= yeoman.app %>/scripts/{,*/}*.coffee'],
//                tasks: ['coffee:dist']
//            },
//            coffeeTest: {
//                files: ['test/spec/{,*/}*.coffee'],
//                tasks: ['coffee:test']
//            },
            compass: {
                files: ['<%= yeoman.app %>/styles/**/*.scss'],
                tasks: ['compass:server', 'autoprefixer']
            },
//            autoprefixer: {
//                files: ['<%= yeoman.app %>/styles/**/*.css'],
//                tasks: ['autoprefixer']
//            },
            livereload: {
                files: [
//                    '<%= yeoman.app %>/{,*/}*.html',
//                    '{.tmp,<%= yeoman.app %>}/styles/{,*/}*.css',
//                    '{.tmp,<%= yeoman.app %>}/scripts/{,*/}*.js',
//                    '<%= yeoman.app %>/images/{,*/}*.{png,jpg,jpeg}'
                    '<%= yeoman.app %>/**/*.html',
                    '{.tmp,<%= yeoman.app %>}/styles/**/*.css',
                    '{.tmp,<%= yeoman.app %>}/scripts/**/*.js',
                    '<%= yeoman.app %>/images/**/*.{png,jpg,jpeg}'
                ],
                tasks: ['livereload']
            }
        },
        connect: {
            livereload: {
                options: {
                    port: 9000,
                    // Change this to '0.0.0.0' to access the server from outside.
                    hostname: 'localhost',
                    middleware: function (connect) {
                        return [
                            lrSnippet,
                            mountFolder(connect, '.tmp'),
                            mountFolder(connect, yeomanConfig.app)
                        ];
                    }
                }
            },
            test: {
                options: {
                    port: 9000,
                    middleware: function (connect) {
                        return [
                            mountFolder(connect, '.tmp'),
                            mountFolder(connect, 'test')
                        ];
                    }
                }
            }
        },
        open: {
            server: {
                url: 'http://localhost:<%= connect.livereload.options.port %>'
            }
        },
        clean: {
            dist: [
                '.tmp',
                '<%= yeoman.dist %>/*'
//                '!<%= yeoman.dist %>/index.php'
            ],
            server: '.tmp',
            postOpti: ['.tmp', '<%= yeoman.dist %>/**/*.bak']
        },
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                '<%= yeoman.app %>/scripts/*.js'
            ]
        },
        // testacular: {
        //   unit: {
        //     configFile: 'testacular.conf.js',
        //     singleRun: true
        //   }
        // },
        coffee: {
            dist: {
                files: {
                    '.tmp/scripts/coffee.js': '<%= yeoman.app %>/scripts/*.coffee'
                }
            },
            test: {
                files: [{
                    expand: true,
                    cwd: '.tmp/spec',
                    src: '*.coffee',
                    dest: 'test/spec'
                }]
            }
        },

        compass: {
            options: {
                sassDir: '<%= yeoman.app %>/styles/sass',
//                cssDir: '<%= yeoman.app %>/styles',
                imagesDir: '<%= yeoman.app %>/images',
                javascriptsDir: '<%= yeoman.app %>/scripts',
                fontsDir: '<%= yeoman.app %>/fonts',
                importPath: '<%= yeoman.app %>/styles/sass',
                relativeAssets: true
            },
            dist: {
                options: {
                    cssDir: '<%= yeoman.dist %>/styles/',
                    environment: 'production',
                    outputStyle: 'compressed',
                    noLineComments : true
                }
            },
            server: {
                options: {
                    cssDir: '<%= yeoman.app %>/styles/',
                    outputStyle: 'expanded',
                    environment: 'development',
                    debugInfo: false
                }
            }
        },

        useminPrepare: {
            html: '<%= yeoman.app %>/index.html',
            options: {
                dest: '<%= yeoman.dist %>'
            }
        },

        usemin: {
            html: ['<%= yeoman.dist %>/{,*/}*.html'],
            // css: ['<%= yeoman.dist %>/styles/{,*/}*.css'],
            options: {
                dirs: ['<%= yeoman.dist %>']
            }
        },

        concat: {
            vendor: {
                files: {
                    '<%= yeoman.dist %>/scripts/vendor.js': [
//                        '.tmp/scripts/*.js',
                        '<%= yeoman.app %>/scripts/vendor/**/*.js'
                    ]
                }
            },
            custom: {
                files: {
                    '<%= yeoman.dist %>/scripts/bnb.js': [
//                        '.tmp/scripts/*.js',
                        '<%= yeoman.app %>/src/app/**/*.js'
                    ]
                }
            },
            landing: {
                files: {
                    '<%= yeoman.dist %>/scripts/landing.js': [
//                        '.tmp/scripts/*.js',
                        '<%= yeoman.app %>/src/landing/**/*.js'
                    ]
                }
            },
            analytics: {
                src: ['<%= yeoman.app %>/scripts/analyticsTracking.js'],
                dest: '<%= yeoman.dist %>/scripts/analyticsTracking.js'
            }
        },

//        uglify: {
//            vendor: {
//                options: {
//                    mangle: false,
//                    compress: true,
//                    report: 'min',
//                    dead_code: true,
//                    preserveComments: false
//                },
//                files: {
//                    '<%= yeoman.dist %>/scripts/vendor.js': [
//                        '<%= yeoman.dist %>/scripts/vendor.js'
//                    ]
//                }
//            },
//
//            custom: {
//                options: {
//                    mangle: false,
//                    compress: true,
//                    report: 'min',
//                    dead_code: true,
//                    preserveComments: false
//                },
//                files: {
//                    '<%= yeoman.dist %>/scripts/bnb.js': [
//                        '<%= yeoman.dist %>/scripts/bnb.js'
//                    ]
//                }
//            }
//        },

        uglify: {
            options: {
                mangle: false,
                compress: true,
                report: 'min',
                dead_code: false,
                preserveComments: false
            },
            vendor: {
                files: {
                    '<%= yeoman.dist %>/scripts/vendor.js': [
                        '<%= yeoman.dist %>/scripts/vendor.js'
                    ]
                }
            },
            custom: {
                files: {
                    '<%= yeoman.dist %>/scripts/bnb.js': [
                        '<%= yeoman.dist %>/scripts/bnb.js'
                    ]
                }
            },
            landing: {
                files: {
                    '<%= yeoman.dist %>/scripts/landing.js': [
                        '<%= yeoman.dist %>/scripts/landing.js'
                    ]
                }
            },
            analytics: {
                files: {
                    '<%= yeoman.dist %>/scripts/analyticsTracking.js': [
                        '<%= yeoman.dist %>/scripts/analyticsTracking.js'
                    ]
                }
            }
        },

        imagemin: {
            options: {
                optimizationLevel : 7
            },
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>/images',
                    src: '{,*/}*.{png,jpg,jpeg}',
                    dest: '<%= yeoman.dist %>/images'
                }]
            }
        },

        // cssmin: {
        //   dist: {
        //     files: {
        //       '<%= yeoman.dist %>/styles/main.css': [
        //         '.tmp/styles/{,*/}*.css',
        //         '<%= yeoman.app %>/styles/main.css'
        //         // '<%= yeoman.app %>/styles/{,*/}*.css'
        //       ]
        //     }
        //   }
        // },

        htmlmin: {
            dist: {
                options: {
                    removeComments: true,
                    removeCommentsFromCDATA: true,
                    // https://github.com/yeoman/grunt-usemin/issues/44
                    collapseWhitespace: true,
                    collapseBooleanAttributes: true,
                    removeAttributeQuotes: true,
                    removeRedundantAttributes: true,
                    useShortDoctype: true,
                    removeEmptyAttributes: true,
                    removeOptionalTags: true
                },
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.app %>',
                    src: ['src/app/**/*.html'],
                    dest: '<%= yeoman.dist %>'
                }]
            },

            prod: {
                options: {
                    removeComments: false,
                    collapseWhitespace: false
                },
                files: {
                    '<%= yeoman.dist %>/index.html': ['<%= yeoman.app %>/index.html']
                }
            },

            landing: {
                options: {
                    removeComments: false,
                    collapseWhitespace: false
                },
                files: {
                    '<%= yeoman.dist %>/landing.html': ['<%= yeoman.app %>/landing.html']
                }
            },

            postProd: {
                options: {
                    removeComments: true,
                    collapseWhitespace: true
                },
                files: {
                    '<%= yeoman.dist %>/index.html': ['<%= yeoman.dist %>/index.html']
                }
            },

            postProdLanding: {
                options: {
                    removeComments: true,
                    collapseWhitespace: true
                },
                files: {
                    '<%= yeoman.dist %>/landing.html': ['<%= yeoman.dist %>/landing.html']
                }
            }
        },

        // cdnify: {
        //   dist: {
        //     html: ['<%= yeoman.dist %>/*.html']
        //   }
        // },

        ngmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= yeoman.dist %>/scripts',
                    src: '*.js',
                    dest: '<%= yeoman.dist %>/scripts'
                }]
            }
        },

        copy: {
            dist: {
                // files: [{
                //   {expand: true,
                //   dot: true,
                //   cwd: '<%= yeoman.app %>',
                //   dest: '<%= yeoman.dist %>',
                //   src: [
                //     '*.{ico,txt}',
                //     '.htaccess'
                //     // 'components/**/*'
                //   ]},
                //   { src: ['<%= yeoman.app %>/images/**'], dest: '<%= yeoman.dist %>/images'},
                //   { src: ['<%= yeoman.app %>/fonts/**'], dest: '<%= yeoman.dist %>/fonts'}
                // }]
                files: [
                    // {src: ['<%= yeoman.app %>/images/*.gif'], dest: '<%= yeoman.dist %>/images/'},
                    // {src: ['<%= yeoman.app %>/fonts/**'], dest: '<%= yeoman.dist %>/fonts/'},
                    {
                        expand: true,
                        cwd: '<%= yeoman.app %>',
                        src: [
                            '*.{ico,txt}',
                            '.htaccess',
                            'images/**/*',
//              'images/**/*.gif',
                            'fonts/**/*'
                        ],
                        dest: '<%= yeoman.dist %>'
                    }
                ]
            }
        },

        imageEmbed: {
            dist: {
                src: [ '<%= yeoman.dist %>/styles/main.css' ],
                dest: "<%= yeoman.dist %>/styles/main.css",
                options: {
                    baseDir: '<%= yeoman.dist %>/',
                    deleteAfterEncoding : false
                }
            }
        },

        hashres: {
            options: {
                // Default value: '${hash}.${name}.cache.${ext}'
                // fileNameFormat: '${hash}.${name}.cache.${ext}',
                fileNameFormat: '${hash}.${name}.${ext}',
                // Optional. Should files be renamed or only alter the references to the files
                // Use it with '${name}.${ext}?${hash} to get perfect caching without renaming your files
                // Default value: true
                renameFiles: true
            },
            // hashres is a multitask. Here 'prod' is the name of the subtask. You can have as many as you want.
            prod: {
                // Specific options, override the global ones
                // Files to hash
                src: [
                    // WARNING: These files will be renamed!
                    '<%= yeoman.dist %>/scripts/bnb.js',
                    '<%= yeoman.dist %>/scripts/analyticsTracking.js',
                    '<%= yeoman.dist %>/styles/main.css'
                ],
                // File that refers to above files and needs to be updated with the hashed name
                dest: '<%= yeoman.dist %>/index.html'
            },
            // hashres is a multitask. Here 'prod' is the name of the subtask. You can have as many as you want.
            landing: {
                // Specific options, override the global ones
                // Files to hash
                src: [
                    // WARNING: These files will be renamed!
                    '<%= yeoman.dist %>/scripts/landing.js',
                    '<%= yeoman.dist %>/styles/landing.css'
                ],
                // File that refers to above files and needs to be updated with the hashed name
                dest: '<%= yeoman.dist %>/landing.html'
            }
        },

        rename: {
            prod: {
                src: '<%= yeoman.dist %>/index.html',
                dest: '<%= yeoman.dist %>/index.php'
            },
            landing: {
                src: '<%= yeoman.dist %>/landing.html',
                dest: '<%= yeoman.dist %>/landing.php'
            }
        },

        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9', 'ff 17', 'opera 12.1', 'android 2.1']
            },
            multiple_files: {
                expand: true,
                flatten: true,
                src: '<%= yeoman.app %>/styles/*.css', // -> src/css/file1.css, src/css/file2.css
                dest: '<%= yeoman.app %>/styles' // -> dest/css/file1.css, dest/css/file2.css
            }
        },

        groundskeeper: {
            dist: { // if multiple files are given, this will keep the same folder structure and files
                expand: true,
                cwd: '<%= yeoman.dist %>/scripts',
                src: ['*.js'],
                dest: '<%= yeoman.dist %>/scripts',
                ext: '.js'
            },

            options: {
                console: false
//                replace: '"0"'                          // Replace removed statements for the given string (note the extra quotes)
            }
        },

        csso: {
            vendor: {
                options: {
                    restructure: true,
                    report: 'min'
                },
                files: {
                    '<%= yeoman.dist %>/styles/vendor.css': ['<%= yeoman.app %>/styles/vendor.css']
                }
            },
            main: {
                options: {
                    restructure: true,
                    report: 'min'
                },
                files: {
                    '<%= yeoman.dist %>/styles/main.css': ['<%= yeoman.app %>/styles/main.css']
                }
            },
            landing: {
                options: {
                    restructure: true,
                    report: 'min'
                },
                files: {
                    '<%= yeoman.dist %>/styles/landing.css': ['<%= yeoman.app %>/styles/landing.css']
                }
            }
        },

        convert: {
            options: {
                explicitArray: false
            },
            xml2json: {
                files: [
                    {
                        expand: true,
                        cwd: './',
                        src: ['sitemap.xml'],
                        dest: './snapshots/',
                        ext: '.json'
                    }
                ]
            }
        },

        replace: {
            index: {
                src: [
                    '<%= yeoman.dist %>/index.php'
                ],             // source files array (supports minimatch)
                dest: '<%= yeoman.dist %>/index.php',             // destination directory or file
                replacements: [
                    {
                        from: '/views/app/',                   // string replacement
                        to: '/views/dist/'
                    },
                    {
                        from: 'src="scripts/',                   // string replacement
                        to: 'src="/application/views/dist/scripts/'
                    }
                ]
            },

            landing: {
                src: [
                    '<%= yeoman.dist %>/landing.php'
                ],             // source files array (supports minimatch)
                dest: '<%= yeoman.dist %>/landing.php',             // destination directory or file
                replacements: [
                    {
                        from: '/views/app/',                   // string replacement
                        to: '/views/dist/'
                    },
                    {
                        from: 'src="scripts/',                   // string replacement
                        to: 'src="/application/views/dist/scripts/'
                    }
                ]
            },

            profileHeader: {
                src: [
                    '<%= yeoman.dist %>/src/app/pages/profile/profileHeader.html'
                ],             // source files array (supports minimatch)
                dest: '<%= yeoman.dist %>/src/app/pages/profile/profileHeader.html',             // destination directory or file
                replacements: [
                    {
                        from: '/views/app/',                   // string replacement
                        to: '/views/dist/'
                    }
                ]
            }
        }

    });

//    grunt.renameTask('regarde', 'watch');
//    // remove when mincss task is renamed
//    grunt.renameTask('mincss', 'cssmin');

    grunt.registerTask('server', [
        'clean:server',
//        'coffee:dist',
        'compass:server',
        'autoprefixer',
        'livereload-start',
        'connect:livereload',
//        'open',
        'watch'
    ]);

//    grunt.registerTask('test', [
//        'clean:server',
//        'coffee',
//        'compass',
//        'connect:test'
//        // 'testacular'
//    ]);

    grunt.registerTask('build', [
        'clean:dist',
//        'jshint',
//        'test',
//        'coffee',
//        'compass:dist',
        'compass:server',
        'autoprefixer',
        'csso',
        'useminPrepare',
        // 'cssmin',
        'htmlmin:dist',
        'htmlmin:prod',
        'htmlmin:landing',
        'concat',
        'copy',
        'imagemin',
        // 'cdnify',
//        'groundskeeper',
        'uglify',
//        'ngmin',
        'usemin',
        'clean:postOpti',
//        'imageEmbed',
        'hashres',
        'htmlmin:postProd',
        'htmlmin:postProdLanding',
        'rename',
        'replace'

    ]);

//    grunt.registerTask('default', ['server']);
};