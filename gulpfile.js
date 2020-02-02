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

const jsFileList = [

	// feature
	'./node_modules/feature.js/feature.js',

	// lazyload
	// './node_modules/vanilla-lazyload/dist/lazyload.js',

	// Jquery
	'./node_modules/jquery/dist/jquery.js',
	// './node_modules/jquery-migrate/dist/jquery-migrate.js',

	// Lazyload
	'./node_modules/lazyloadxt/dist/jquery.lazyloadxt.js',
	'./node_modules/lazyloadxt/dist/jquery.lazyloadxt.srcset.js',

	//
	// // Fastclick
	// src + 'bower-components/fastclick/lib/fastclick.js',

	// Picturefill
	// sourcePath + 'bower-components/dist/picturefill.js',

	// Simple state manager
	// sourcePath + 'bower-components/SimpleStateManager/src/ssm.js',

	// Slick
	'./node_modules/slick-slider/slick/slick.js',

	// Foundation
	'./node_modules/foundation-sites/assets/js/foundation.core.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.util.box.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.util.keyboard.js',
	'./node_modules/foundation-sites/assets/js/foundation.util.mediaQuery.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.util.motion.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.util.nest.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.util.timerAndImageLoader.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.util.touch.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.util.triggers.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.abide.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.accordion.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.accordionMenu.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.drilldown.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.dropdown.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.dropdownMenu.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.equalizer.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.interchange.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.magellan.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.offcanvas.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.orbit.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.responsiveMenu.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.responsiveToggle.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.reveal.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.slider.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.sticky.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.tabs.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.toggler.js',
	//sourcePath + 'bower-components/foundation-sites/assets/js/foundation.tooltip.js',

	// src + 'bower-components/slick/slick/slick.js',
	'./node_modules/swipebox/src/js/jquery.swipebox.js',
	'./node_modules/slideout/dist/slideout.js',
	'./node_modules/masonry-layout/dist/masonry.pkgd.js',
	'./node_modules/imagesloaded/imagesloaded.js',

	// Own stuff
	src + 'assets/js/feature.js',
	src + 'assets/js/lazyload.js',
	// src + 'assets/js/lazyload-vanilla.js',
	src + 'assets/js/masonry.js',
	src + 'assets/js/swipebox.js',
	src + 'assets/js/slick.js',
	src + 'assets/js/slideout.js',
];

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

console.log(jsFileList);

const gulpJs = () => {
	gulp.src(jsFileList)
		// .pipe(sourcemaps.init()) // start sourcemap
		.pipe(plumber()) // prevent gulp crash on error event
		.pipe(concat('app.js')) // define filename after merging all files
		.pipe(babel({
			presets: ['es2015']
		})) // Use ES6 or ES7 and compile to "normal" javascript for browsercompatibility
		// .pipe(browserify({
		// 	insertGlobal: true
		// })) // Use fileimports from node modules
		// .pipe(uglify()) // minify javascript
		.pipe(rename({suffix: '.min'})) // add suffix
		// .pipe(sourcemaps.write('.')) // write sourcemap
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
	gulp.watch([src + 'assets/assets/js/*.js'], ['js']);
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
