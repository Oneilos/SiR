'use strict';

var gulp = require('gulp'), _ = require('lodash'), exec = require('child_process').exec;

gulp.paths = {};

var bundles = ['Dextr', 'Huntr', 'Linkr'], paths = {
  src: 'src',
  bower: 'bower_components',
  dist: '../public',
  tmp: '.tmp',
  e2e: 'e2e',
  root: ''
};

function buildPaths(bundle) {
  gulp.paths = _.reduce(paths, function (results, path, key) {
    results[key] = 'src/' + bundle + '/Bundle/AngularBundle/Resources/angular/' + (path || '');
    return results;
  }, {module: bundle});
}

function runTasksSync(tasks) {
  gulp.start(tasks.pop(), tasks.length > 0 ? runTasksSync.bind(this, tasks) : function () {});
}

require('require-dir')('./gulp');

gulp.task('default', function () {

});

// Make a build, serve and test function for each angular app
bundles.forEach(function (bundle) {
  _.each(['build', 'clean', 'serve', 'test'], function (task) {
    gulp.task(task + '-' + bundle.toLowerCase(), function () {
      buildPaths(bundle);
      gulp.start(task);
    });
  });

  // Bower install task for each bundle
  gulp.task('install-' + bundle.toLowerCase(), function (cb) {
    buildPaths(bundle);
    exec('bower install', {cwd: gulp.paths.root}, function (err, out) {
      console.log(out || 'Bower dependencies already up to date');
      cb(err);
    });
  });
});

// Global commands for all bundles at the same time
_.each(['install', 'build', 'clean', 'test'], function (task) {
  gulp.task(task + '-all', function () {
    runTasksSync(bundles.map(function (bundle) {return task + '-' + bundle.toLowerCase();}));
  });
});
