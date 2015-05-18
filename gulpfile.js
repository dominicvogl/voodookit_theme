//
// Gulp Configuration
//------------------------------------------------------------------------

//
// Include necessary gulp files
// ------------------------------------------------------------------------

var
   gulp = require('gulp'),
// path = require('path'),
   minifyCSS = require('gulp-minify-css'),
   less = require('gulp-less'),
   concat = require('gulp-concat'),
   uglify = require('gulp-uglify'),
   plumber = require('gulp-plumber'),
   rename = require("gulp-rename"),
   watch = require('gulp-watch'),
   themepath = 'custom/themes/bwrk_devkit';



//
// Compile LESS files
//------------------------------------------------------------------------

gulp.task('styles', function () {

   gulp.src(themepath + '/src/less/main.less')
      .pipe(plumber())
      .pipe(less())
      .pipe(rename({basename: 'app', extname: '.css'}))
      .pipe(gulp.dest(themepath + '/css/'))
      .pipe(minifyCSS())
      .pipe(rename({suffix: '.min'}))
      .pipe(gulp.dest(themepath + '/css/'))

});

//
// Concatenate & Minify JS
// ------------------------------------------------------------------------

gulp.task('scripts', function () {

   var filelist = [

      // Load Bootstrap stuff
      themepath+'/src/js/libs/jquery.js',
      //themepath+'/src/js/bootstrap/affix.js',
      //themepath+'/src/js/bootstrap/alert.js',
      //themepath+'/src/js/bootstrap/button.js',
      //themepath+'/src/js/bootstrap/carousel.js',
      //themepath+'/src/js/bootstrap/collapse.js',
      //themepath+'/src/js/bootstrap/dropdown.js',
      //themepath+'/src/js/bootstrap/modal.js',
      //themepath+'/src/js/bootstrap/popover.js',
      //themepath+'/src/js/bootstrap/scrollspy.js',
      //themepath+'/src/js/bootstrap/tab.js',
      //themepath+'/src/js/bootstrap/tooltip.js',
      //themepath+'/src/js/bootstrap/transitions.js',
      themepath+'/src/js/libs/slick.js',

      // Load own stuff
      themepath + '/src/js/custom/*.js'
   ];

   gulp.src(filelist)
      .pipe(plumber())
      .pipe(concat('app.js'))
      .pipe(gulp.dest(themepath + '/js/'))
      .pipe(uglify('compress'))
      .pipe(rename({suffix: '.min'}))
      .pipe(gulp.dest(themepath + '/js/'))

});

//
// Watch files for changes
// ------------------------------------------------------------------------

gulp.task('watch', function () {
   gulp.watch(themepath + '/src/less/**/*.less', ['styles'], errorHandling);
   gulp.watch(themepath + '/src/js/**/*.js', ['scripts'], errorHandling);
});

//
// Define default Tasks
//------------------------------------------------------------------------

gulp.task('default', ['styles', 'scripts', 'watch']);

//
// Functions
//------------------------------------------------------------------------

/**
 * Error handler function
 * @param event
 * @returns {*}
 */

function errorHandling(event) {
   return gulp.src(event.path)
      .pipe(refresh(lrserver));
}