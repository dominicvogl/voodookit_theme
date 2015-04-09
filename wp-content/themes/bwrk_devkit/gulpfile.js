//
// Gulp Configuration
//------------------------------------------------------------------------


//
// Include necessary gulp files
// ------------------------------------------------------------------------

var gulp =
   require('gulp'),
// path = require('path'),
   minifyCSS = require('gulp-minify-css'),
   less = require('gulp-less'),
   concat = require('gulp-concat'),
// uglify = require('gulp-uglify'),
   plumber = require('gulp-plumber'),
// rename = require("gulp-rename");
// sourcemaps = require("gulp-sourcemaps");
// autoprefixer = require("gulp-autoprefixer");
   watch = require('gulp-watch');


var onError = function(event) {
   return gulp.src(event.path)
      .pipe(refresh(lrserver));
};

//
// Compile SASS files
//------------------------------------------------------------------------

gulp.task('styles', function () {

   gulp.src('fileadmin/templates/default/src/less/main.less')
      .pipe(plumber())
      .pipe(less())
      .pipe(minifyCSS())
      .pipe(gulp.dest('fileadmin/templates/default/css'));
});



//
// Concatenate & Minify JS
// ------------------------------------------------------------------------

gulp.task('scripts', function() {

   var filelist = [

      // Load jquery files
      'fileadmin/templates/default/src/js/lib/jquery.js',

      //'fileadmin/templates/default/src/js/lib/polyfill.js',
      //'fileadmin/templates/default/src/js/lib/hyphenator.js',
      'fileadmin/templates/default/src/js/lib/modernizr.js',
      'fileadmin/templates/default/src/js/lib/ssm.js',
      'fileadmin/templates/default/src/js/lib/fastclick.js',
      'fileadmin/templates/default/src/js/lib/picturefill.js',
      'fileadmin/templates/default/src/js/lib/fluidbox.js',
      'fileadmin/templates/default/src/js/lib/responsive-tables.js',
      'fileadmin/templates/default/src/js/lib/snap.js',

      // Load Bootstrap files
      // 'fileadmin/templates/default/src/js/lib/bootstrap/affix.js',
      //'fileadmin/templates/default/src/js/lib/bootstrap/alert.js',
      'fileadmin/templates/default/src/js/lib/bootstrap/button.js',
      'fileadmin/templates/default/src/js/lib/bootstrap/select.js',
      // 'fileadmin/templates/default/src/js/lib/bootstrap/carousel.js',
      //'fileadmin/templates/default/src/js/lib/bootstrap/collapse.js',
      'fileadmin/templates/default/src/js/lib/bootstrap/dropdown.js',
      'fileadmin/templates/default/src/js/lib/bootstrap/submenu.js',
      // 'fileadmin/templates/default/src/js/lib/bootstrap/modal.js',
      // 'fileadmin/templates/default/src/js/lib/bootstrap/popover.js',
      // 'fileadmin/templates/default/src/js/lib/bootstrap/scrollspy.js',
      // 'fileadmin/templates/default/src/js/lib/bootstrap/tab.js',
      // 'fileadmin/templates/default/src/js/lib/bootstrap/tooltip.js',
      'fileadmin/templates/default/src/js/lib/bootstrap/transition.js',

      // Load own librarys
      'fileadmin/templates/default/src/js/lib/slick.js',

      // Load own stuff
      'fileadmin/templates/default/src/js/custom/*.js'
   ];

   gulp.src(filelist)
      .pipe(plumber())
      .pipe(concat('main.js'))
      //.pipe(uglify('compress'))
      .pipe(gulp.dest('fileadmin/templates/default/js/'))
});



//
// Watch files for changes
// ------------------------------------------------------------------------

gulp.task('watch', function() {
   gulp.watch('fileadmin/templates/default/src/less/**/*.less', ['styles'], onError);
   gulp.watch('fileadmin/templates/default/src/js/**/*.js', ['scripts'], onError);
});



//
// Define default Tasks
//------------------------------------------------------------------------

gulp.task('default', ['styles', 'scripts', 'watch'])