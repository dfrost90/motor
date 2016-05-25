'use strict';

const gulp   = require('gulp'),
    plugins  = require('gulp-load-plugins')(),
    pngQuant = require('imagemin-pngquant'),
    iconfontCss = require('gulp-iconfont-css'),
    del      = require('del'),
    server   = require('browser-sync'),
    browserify = require('browserify'),
    source = require('vinyl-source-stream'),
    buffer = require('vinyl-buffer');

gulp
  .task('styles', function () {
    return gulp.src('assets/styles/src/main.less')
      .pipe(plugins.plumber())
      .pipe(plugins.sourcemaps.init())
      .pipe(plugins.less())
      .pipe(plugins.postcss([
          require('postcss-import'),
          require('autoprefixer')({ browsers: ['last 2 versions'] }),
          require('css-mqpacker')
        ]))
      .pipe(plugins.cssnano())
      .pipe(plugins.size())
      .pipe(plugins.sourcemaps.write())
      .pipe(gulp.dest('./assets/styles/dist/'));
  })
  .task('scripts', function() {
    // set up the browserify instance on a task basis
    var b = browserify({
      entries: './assets/scripts/src/main.js',
      debug: true
    });

    return b.bundle()
      .pipe(source('main.js'))
      .pipe(buffer())
      .pipe(plugins.sourcemaps.init({loadMaps: true}))
          // Add transformation tasks to the pipeline here.
          .pipe(plugins.uglify())
          .on('error', plugins.util.log)
      .pipe(plugins.sourcemaps.write('./'))
      .pipe(gulp.dest('./assets/scripts/dist/'));
  })
  .task('iconfont', function () {
    return gulp.src('assets/icons/*.svg')
      .pipe(iconfontCss({
        fontName: 'icons',
        path: './assets/styles/src/iconfont.less',
        targetPath: '../../styles/src/icons.less',
        fontPath: '../../fonts/icons/'
      }))
      .pipe(plugins.iconfont({
        fontName: 'icons',
        normalize: true,
        formats: ['svg', 'ttf', 'eot', 'woff', 'woff2']
      }))
      .pipe(gulp.dest('./assets/fonts/icons/'));
  })
  .task('images', function () {
    return gulp.src('assets/images/src/*')
      .pipe(plugins.imagemin({
        progressive: true,
        interlaced: true,
        svgoPlugins: [{cleanupIDs: false}],
        use: [pngQuant({quality: '65-80', speed: 4})]
      }))
      .pipe(gulp.dest('./assets/images/dist/'));
  })
  .task('clean', function () {
    return del(['./assets/*/dist/', '!./assets/images/dist/']);
  })
  .task('serve', ['clean', 'styles', 'scripts'], function () {
    server({
      notify: false,
      port: 9000,
      server: {
        baseDir: ['.']
      }
    });

    gulp.watch([
        'index.html',
        './assets/styles/dist/main.css'
      ]).on('change', server.reload);

    gulp.watch('assets/styles/src/**/*.less', ['styles']);
    gulp.watch('assets/scripts/src/**/*.js', ['scripts']);
    gulp.watch('assets/images/src/**/*', ['images']);
  })
  .task('build', function () {

  })
  .task('default', ['clean', 'styles', 'scripts']);
