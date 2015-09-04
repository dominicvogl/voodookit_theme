//
// Gulp Configuration
//------------------------------------------------------------------------

// Define Basepaths
var sourcepath = 'custom/themes/template/';

// Include gulp
var
   gulp = require('gulp'),
   uglify = require('gulp-uglify'),
   concat = require('gulp-concat'),
   sass = require('gulp-sass'),
   watch = require('gulp-watch'),
   w3cjs = require('gulp-w3cjs'),
   through2 = require('through2'),
   themepath = 'custom/themes/bwrk_devkit';

plumber = require('gulp-plumber'),
   iconfont = require('gulp-iconfont'),
   consolidate = require('gulp-consolidate'),
   path = require('path'),
   rename = require("gulp-rename");

var filelist = [

   // Foundation Stuff
   //'src/js/libs/foundation/foundation.js',
   //'src/js/libs/foundation/foundation.abide.js',
   //'src/js/libs/foundation/foundation.accordion.js',
   //'src/js/libs/foundation/foundation.alert.js',
   //'src/js/libs/foundation/foundation.clearing.js',
   //'src/js/libs/foundation/foundation.dropdown.js',
   //'src/js/libs/foundation/foundation.equalizer.js',
   //'src/js/libs/foundation/foundation.interchange.js',
   //'src/js/libs/foundation/foundation.joyride.js',
   //'src/js/libs/foundation/foundation.magellan.js',
   //'src/js/libs/foundation/foundation.offcanvas.js',
   //'src/js/libs/foundation/foundation.orbit.js',
   //'src/js/libs/foundation/foundation.reveal.js',
   //'src/js/libs/foundation/foundation.slider.js',
   //'src/js/libs/foundation/foundation.tab.js',
   //'src/js/libs/foundation/foundation.tooltip.js',
   //'src/js/libs/foundation/foundation.topbar.js',

   // Your Own Stuff
   sourcepath + 'src/js/libs/custom/fastclick.js',
   sourcepath + 'src/js/libs/custom/jquery.min.js',
   sourcepath + 'src/js/libs/custom/modernizr.js',
   sourcepath + 'src/js/custom/custom.js'

];

//
// Gulp Tasks
// ------------------------------------------------------------------------------------

// Watch files for changes
gulp.task('watch', watchTask);

// Generate Icons
gulp.task('icons', iconsTask);

// Compile SASS files
gulp.task('styles', stylesTask);

// Compile
gulp.task('scripts', scriptTask);

// Validate
gulp.task('validate', w3cValidate);

// Default Task
gulp.task('default', ['styles', 'scripts', 'watch']);

//
// Gulp Functions
// ------------------------------------------------------------------------------------

function stylesTask() {

   var compileStyles = function (_baseName) {
      gulp.src([sourcepath + '/src/scss/' + _baseName + '.scss'])
         .pipe(plumber())
         .pipe(sass({outputStyle: 'nested'}))
         .pipe(gulp.dest(sourcepath + '/css'))
         .pipe(rename({suffix: '.min'}))
         .pipe(sass({outputStyle: 'compressed'}))
         .pipe(gulp.dest(sourcepath + '/css'));
   };

   compileStyles('app');

}

function w3cValidate() {

   gulp.src('*.html')
      .pipe(w3cjs())
      .pipe(through2.obj(function (file, enc, cb) {
         cb(null, file);
         if (!file.w3cjs.success) {
            throw new Error('HTML validation error(s) found');
         }
      }));

}

function scriptTask() {
   gulp.src(filelist)
      .pipe(plumber())
      .pipe(concat('/app.js'))
      .pipe(gulp.dest(sourcepath + 'js'))
      .pipe(uglify())
      .pipe(rename({suffix: '.min'}))
      .pipe(gulp.dest(sourcepath + 'js'))
}

function watchTask() {
   gulp.watch(sourcepath + 'src/scss/**/*.scss', ['styles']);
   gulp.watch(sourcepath + 'src/js/**/*.js', ['scripts']);
}

function iconsTask() {
   gulp.src([sourcepath + '/src/svg/*.svg'])
      .pipe(iconfont({
         fontName: 'icon',
         appendCodepoints: true,
         normalize: true,
         //fontHeight: 500
      }))
      .on('codepoints', function (codepoints, options) {
         gulp.src(sourcepath + '/src/scss/template/icons.scss')
            .pipe(consolidate('lodash', {
               glyphs: codepoints,
               fontName: 'icon',
               fontPath: '../fonts/',
               className: 'icon'
            }))
            .pipe(gulp.dest(sourcepath + '/src/scss/generated/'));
      })
      .pipe(gulp.dest(sourcepath + '/fonts/'));
}