'use strict';

var gulp = require('gulp');

var $ = require('gulp-load-plugins')();

var wiredep = require('wiredep');

function runTests (singleRun, cb) {
  var bowerDeps = wiredep({
    cwd: gulp.paths.root,
    exclude: ['bootstrap-sass-official'],
    dependencies: true,
    devDependencies: true
  });

  var testFiles = bowerDeps.js.concat([
    gulp.paths.src + '/{app,components}/**/*.js'
  ]);

  gulp.src(testFiles)
    .pipe($.karma({
      configFile: gulp.paths.root + 'karma.conf.js',
      action: (singleRun)? 'run': 'watch'
    }))
    .on('error', function (err) {
      // Make sure failed tests cause gulp to exit non-zero
      throw err;
    })
    .on('end', function () {
      cb();
    });
}

gulp.task('test', function (done) { runTests(true /* singleRun */, done); });
gulp.task('test:auto', function (done) { runTests(false /* singleRun */, done); });
