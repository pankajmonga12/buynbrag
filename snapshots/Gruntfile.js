module.exports = function(grunt) {

//    var siteMap = grunt.file.read("./siteLinks.json");
//    siteMap = siteMap.replace(/\\/g,"");
//    var arrTest = new Array(siteMap);

    var siteMap = grunt.file.readJSON("./sitemap.json");
//    console.log(siteMap);

    var arr = [];
    var elem, result;
    var parse_url = /^(?:([A-Za-z]+):)?(\/{0,3})([0-9.\-A-Za-z]+)(?::(\d+))?(?:\/([^?#]*))?(?:\?([^#]*))?(?:#(.*))?$/;

    for(i=0, len= siteMap.urlset.url.length; i<len; i++){
        elem = siteMap.urlset.url[i].loc;

//        arr[arr.length] = elem.substr(elem.search('#!'));
        result = parse_url.exec(elem);
        arr[arr.length] = result[5];
    }

//    console.log(arr);

//    grunt.file.write("./manish.json", arrTest);

//    console.log(arrTest[0]);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        htmlSnapshot: {
            all: {
                options: {
                    //that's the path where the snapshots should be placed
                    //it's empty by default which means they will go into the directory
                    //where your Gruntfile.js is placed
                    snapshotPath: 'snapshots/',
                    //This should be either the base path to your index.html file
                    //or your base URL. Currently the task does not use it's own
                    //webserver. So if your site needs a webserver to be fully
                    //functional configure it here.
                    sitePath: 'https://buynbrag.com/',
                    //you can choose a prefix for your snapshots
                    //by default it's 'snapshot_'
                    fileNamePrefix: 'sp_',
                    //by default the task waits 500ms before fetching the html.
                    //this is to give the page enough time to to assemble itself.
                    //if your page needs more time, tweak here.
                    msWaitForPages: 5000,
                    //if you would rather not keep the script tags in the html snapshots
                    //set `removeScripts` to true. It's false by default
                    removeScripts: true,
                    // allow to add a custom attribute to the body
                    bodyAttr: 'data-prerendered',
                    //here goes the list of all urls that should be fetched
                    urls: arr
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
                        src: ['../sitemap.xml'],
                        dest: './snapshots/',
                        ext: '.json'
                    }
                ]
            }
        }

    });

    grunt.loadNpmTasks('grunt-html-snapshot');
    grunt.loadNpmTasks('grunt-convert');
    grunt.loadTasks('tasks');

    grunt.registerTask('default', [
        'convert',
        'htmlSnapshot'
    ]);

};