(function() {
  'use strict';

  function git(argv) {
    // Dont' let git's output interfere with grunt logging
    var output = {stdio: [0, null, null]},
      exec = require('child_process').execSync;
    exec('git ' + argv, output);
  }

  // Basic template description
  exports.description = 'Scaffolds a new WordPress MyPlay starter plugin with GruntJs and Compass';

  // Any existing file or directory matching this wildcard will cause a warning.
  exports.warnOn = '*';

  // The actual init template.
  exports.template = function(grunt, init, done) {

    init.process({}, [
      // Prompt for these values
      init.prompt('name'),
      init.prompt('title'),
      init.prompt('description'),
      init.prompt('version', '0.0.1'),
      init.prompt('pluginName', 'MyPlayPlugin'),
    ], function(err, props) {

      props.name = props.name.indexOf('wp-') !== 0 ? 'wp-' + props.name : props.name;

      // Files to copy (and process).
      var files = init.filesToCopy(props),
        pluginFolder = props['pluginName'];

      // Update file paths to reflect the name specified from prompt
      for (var file in files) {
        if (file.indexOf('MyPlay/') > -1) {

          var path = files[file],
            newFilePath = file.replace('MyPlay/', pluginFolder + '/');

          files[newFilePath] = path;

          delete files[file];
        }
      }

      // Actually copy (and process) the files.
      init.copyAndProcess(files, props);

      // Empty folders won't be copied over so we need to create them dynamically.
      grunt.file.mkdir('scripts');
      grunt.file.mkdir('styles');

      // Generate package.json file for npm and grunt
      init.writePackageJSON('package.json', {
        "name": props.name,
        "description": props.description,
        "version": props.version,
        "devDependencies": {
          "grunt": "~0.4.x",
          "grunt-contrib-watch": "~0.6.x",
          "grunt-contrib-clean": "^0.6.0",
          "grunt-contrib-compass": "~0.4.x",
          "grunt-contrib-uglify": "~0.9.x",
          "grunt-contrib-cssmin": "^0.13.0",
          "grunt-scss-lint": "^0.3.8",
          "grunt-browserify": "^4.0.1"
        }
      });

      // All done!
      done();

      try {
        grunt.log.write('\nInitializing Git repository...');
        git('init -q');
        git('add .');
        git('remote add origin git@github.com:rgenerator/' + props['wp-plugin-name'].toLowerCase() + '.git');
        grunt.log.ok();
      } catch (e) {
        grunt.log.writeln();
        grunt.fail.warn('git initialization failed: ' + e.message);
      }

    });
  }

})();
