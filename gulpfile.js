/**
 * @function require
 * @type {Gulp}
 */

const 	gulp = require('gulp'),
	sass = require('gulp-sass'),
	cleanCSS = require('gulp-clean-css'),
	autoprefixer = require('gulp-autoprefixer'),
	rename = require('gulp-rename'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	plumber = require('gulp-plumber'),
	babel = require('gulp-babel'),
	browserify = require('gulp-browserify'),
	sourcemaps = require('gulp-sourcemaps'),
	svgSprite = require('gulp-svg-sprite'),
	browserSync = require('browser-sync');

const 	src = './src/',
	dist = './dist/';


/**
 * Compile and compress sass files into css file
 * @since 1.0.0
 */

const gulpScss = () => {
	gulp.src(src + 'assets/scss/*.scss')
		.pipe(sourcemaps.init())
		// .pipe(clean())
		.pipe(plumber())
		.pipe(sass())
		.pipe(autoprefixer())
		// .pipe(rename({basename: 'app'}))
		// .pipe(gulp.dest(dist + 'assets/css'))
		.pipe(cleanCSS())
		.pipe(rename({suffix: '.min'}))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(dist + 'assets/css'))
		.pipe(browserSync.stream());
};


/**
 * Concat javascript files and compress them
 * @since 1.0.0
 */

const gulpJs = () => {
	gulp.src(src + 'assets/js/*.js')
		.pipe(sourcemaps.init()) // start sourcemap
		.pipe(plumber()) // prevent gulp crash on error event
		.pipe(concat('app.js')) // define filename after merging all files
		.pipe(babel({
			presets: ['es2015']
		})) // Use ES6 or ES7 and compile to "normal" javascript for browsercompatibility
		.pipe(browserify({
			insertGlobal: true
		})) // Use fileimports from node modules
		.pipe(uglify()) // minify javascript
		.pipe(rename({suffix: '.min'})) // add sufficx
		.pipe(sourcemaps.write('.')) // write sourcemap
		.pipe(gulp.dest(dist + 'assets/js')) // define destination folder
		.pipe(browserSync.stream());
};



/**
 * Gulp generate SVG Sprite
 */

const gulpSvg = () => {

	gulp.src('**/*.svg', { cwd: src + 'assets/svg/' })
		.pipe(plumber())
		.pipe(svgSprite(
			{
				mode: {
					'symbol': {
						'dest': './assets/svg',
						'sprite': 'sprite-symbol'
					}
				}
			}
		))
		.on('error', function(error) {
			/* Do some awesome error handling ... */
		})
		.pipe(gulp.dest(dist));

};

/**
 * Watch some files and their changes
 */

const gulpWatch = () => {

	// watch some files
	gulp.watch([src + 'assets/scss/**/*.scss'], ['scss']);
	gulp.watch([src + 'assets/js/*.js'], ['js']);
	gulp.watch([src + 'assets/svg/*.svg'], ['svg']);

};


/**
 * Default gulp task
 */

const gulpDefault = () => {

	// Initial compiling of files
	gulpScss();
	gulpJs();
	gulpSvg();
	// gulpHTML();

	// Start browsersync server
	// browserSync.init({
	//     server: './dist' // define folder to watch
	// }); // start server for effective developing

	gulpWatch();
};


/**
 * Define all the gulp tasks
 */

gulp.task('scss', gulpScss);
gulp.task('js', gulpJs);
// gulp.task('html', gulpHTML);
gulp.task('svg', gulpSvg);
gulp.task('watch', gulpWatch());
gulp.task('default', gulpDefault());
