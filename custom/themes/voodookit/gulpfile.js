const gulp = require('gulp'),
    sass = require('gulp-sass'),
    cleanCSS = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    rename = require('gulp-rename'),
    inject = require('gulp-inject'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    plumber = require('gulp-plumber'),
    babel = require('gulp-babel'),
    browserify = require('gulp-browserify'),
    clean = require('gulp-clean'),
    sourcemaps = require('gulp-sourcemaps'),
    htmlmin = require('gulp-html-minifier'),
    iconfont = require('gulp-iconfont'),
    consolidate = require('gulp-consolidate'),
    path = require('path'),
    browserSync = require('browser-sync');


const src = './src/',
    dist = './dist/';


// ################################
// Minify SASS

const gulpScss = () => {
    gulp.src(src + 'assets/scss/*.scss')
        .pipe(sourcemaps.init())
        // .pipe(clean())
        .pipe(plumber())
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(rename({basename: 'app'}))
        // .pipe(gulp.dest(dist + 'assets/css'))
        .pipe(cleanCSS())
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(dist + 'assets/css'))
        .pipe(browserSync.stream());
};


// ################################
// Minify JS

const gulpJS = () => {
    gulp.src(src + 'assets/js/*.js')
        .pipe(sourcemaps.init()) // start sourcemap
        .pipe(plumber()) // prevent gulp crash on error event
        .pipe(concat('app.js')) // define filename after merging all files
        .pipe(babel({
            presets: ['es2015']
        })) // Use ES6 or ES7 and compile to "normal" javascript for browsercompatibility
        .pipe(browserify({
            insertGlobal: true,
            debug: !gulp.env.production
        })) // Use fileimports from node modules
        .pipe(uglify()) // minify javascript
        .pipe(rename({suffix: '.min'})) // add sufficx
        .pipe(sourcemaps.write('.')) // write sourcemap
        .pipe(gulp.dest(dist + 'assets/js')) // define destination folder
        .pipe(browserSync.stream());
};


// ################################
// Minify HTML

const gulpHTML = () => {
    gulp.src(dist + '*.html', {force: true})
        .pipe(clean());
    gulp.src(src + '*.html')
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe(gulp.dest(dist))
        .pipe(browserSync.stream());
};


gulp.task('icons', iconsTask);

function iconsTask() {
    gulp.src([sourcePath + 'assets/svg/use/*.svg'])
        .pipe(iconfont({
            fontName: 'icon',
            appendCodepoints: true
        }))
        .on('codepoints', function (codepoints, options) {
            gulp.src(sourcePath + 'scss/templates/_icons.scss')
                .pipe(consolidate('lodash', {
                    glyphs: codepoints,
                    fontName: 'icon',
                    fontPath: '../fonts/generated/',
                    className: 'icon'
                }))
                .pipe(gulp.dest(sourcePath + 'scss/generated'));
        })
        .pipe(gulp.dest(destinationPath + 'fonts/generated'));
}


// ################################
// define gulp tasks

gulp.task('scss', gulpScss);
gulp.task('js', gulpJS);
// gulp.task('html', gulpHTML);


// ################################
// Watcher

gulp.task('default', function () {
    // Initial compiling of files
    gulpScss();
    gulpJS();
    // gulpHTML();

    // Start browsersync server
    // browserSync.init({
    //     server: './dist' // define folder to watch
    // }); // start server for effective developing

    // watch some files
    // gulp.watch([src + '*.html'], ['html']);
    gulp.watch([src + 'assets/scss/*.scss'], ['scss']);
    gulp.watch([src + 'assets/js/*.js'], ['js']);
});
