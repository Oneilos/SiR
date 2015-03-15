'use strict';

var gulp = require('gulp');

var $ = require('gulp-load-plugins')();

gulp.task('styles', function () {
  var paths = gulp.paths;

  var sassOptions = {
    style: 'expanded'
  };

  var injectFiles = gulp.src([
    paths.src + '/{scss,components}/**/*.scss',
    '!' + paths.src + '/scss/main.scss',
    '!' + paths.src + '/scss/vendor.scss'
  ], { read: false });

  var injectOptions = {
    transform: function(filePath) {
      filePath = filePath.replace(paths.src + '/scss/', '');
      filePath = filePath.replace(paths.src + '/components/', '../components/');
      return '@import \'' + filePath + '\';';
    },
    starttag: '// injector',
    endtag: '// endinjector',
    addRootSlash: false
  };

  var indexFilter = $.filter('main.scss');

  return gulp.src([
    paths.src + '/scss/main.scss',
    paths.src + '/scss/vendor.scss'
  ])
    .pipe(indexFilter)
    .pipe($.inject(injectFiles, injectOptions))
    .pipe(indexFilter.restore())
    .pipe($.sass(sassOptions))

  .pipe($.autoprefixer())
    .on('error', function handleError(err) {
      console.error(err.toString());
      this.emit('end');
    })
    .pipe(gulp.dest(paths.tmp + '/serve/app/'));
});
