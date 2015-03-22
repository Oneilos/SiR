'use strict';

var gulp = require('gulp');

gulp.task('watch', ['inject'], function () {
  gulp.watch([
    gulp.paths.src + '/*.html',
    gulp.paths.src + '/{app,components,scss}/**/*.scss',
    gulp.paths.src + '/{app,components}/**/*.js',
    gulp.paths.root + 'bower.json'
  ], ['inject']);
});
