// Load variables from gulp for easier use
const { src, dest, watch, series, parallel } = require('gulp');

// SCSS Workflow
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const combineq = require('postcss-combine-media-query');
const cssnano = require('cssnano');

// Javascript workflow
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const babel = require('gulp-babel');

// Browserify workflow
const browserify = require('browserify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');

// Image Optimization workflow
const imagemin = require('gulp-imagemin');
const svgsprite = require('gulp-svg-sprite');

// String replacement for cache custing task
const replace = require('gulp-replace');

// Browsersync
const browsersync = require('browser-sync').create();

// Roomcleaner
const del = require('del');

// define some folders
const scssSrc = 'src/assets/scss';
const jsSrc = 'src/assets/js';
const imageSrc = 'src/assets/img';
const svgSrc = 'img';
const dist = 'dist';
const jsFileList = [

	// feature
	'./node_modules/feature.js/feature.js',

	// lazyload
	// '/vanilla-lazyload/dist/lazyload.js',

	// Jquery
	'./node_modules/jquery/dist/jquery.js',
	// '/jquery-migrate/dist/jquery-migrate.js',

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
	'./node_modules/foundation-sites/dist/js/plugins/foundation.core.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.util.box.js',
	'./node_modules/foundation-sites/dist/js/plugins/foundation.util.keyboard.js',
	'./node_modules/foundation-sites/dist/js/plugins/foundation.util.mediaQuery.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.util.motion.js',
	'./node_modules/foundation-sites/dist/js/plugins/foundation.util.nest.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.util.timerAndImageLoader.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.util.touch.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.util.triggers.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.abide.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.accordion.js',
	'./node_modules/foundation-sites/dist/js/plugins/foundation.accordionMenu.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.drilldown.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.dropdown.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.dropdownMenu.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.equalizer.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.interchange.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.magellan.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.offcanvas.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.orbit.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.responsiveMenu.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.responsiveToggle.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.reveal.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.slider.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.sticky.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.tabs.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.toggler.js',
	//sourcePath + 'bower-components/foundation-sites/js/foundation.tooltip.js',

	// src + 'bower-components/slick/slick/slick.js',
	'./node_modules/swipebox/src/js/jquery.swipebox.js',
	'./node_modules/slideout/dist/slideout.js',
	'./node_modules/masonry-layout/dist/masonry.pkgd.js',
	'./node_modules/imagesloaded/imagesloaded.js',

	// Own stuff
	jsSrc + '/feature.js',
	jsSrc + '/foundation.js',
	jsSrc + '/lazyload.js',
	// src + 'assets/js/lazyload-vanilla.js',
	jsSrc + '/masonry.js',
	jsSrc + '/swipebox.js',
	jsSrc + '/slick.js',
	jsSrc + '/slideout.js',
];


/**
 * Compile the SCSS files to CSS file
 * @returns {*}
 */

function scssDevTask() {

	return src( [scssSrc + '/app.scss', scssSrc + '/gutenberg.scss'], {sourcemaps: true}) // export with sourcemaps
		.pipe(sass({
			includePaths: [ // include paths for compiling the files
				'node_modules/'
			]
		})) // compile scss
		.pipe(postcss([autoprefixer])) // use autoprefixer (browser support), combine mediaqueries to one query (great!) and remove the css from trash (comments, spaces, etc.)
		.pipe(dest('dist/assets/css', { sourcemaps: '.'})); // target folder for the compiled file and sourcemaps
}


/**
 * compile scss files
 * @returns {*}
 */

function scssProdTask() {

	return src( [scssSrc + '/app.scss', scssSrc + '/gutenberg.scss'], {sourcemaps: true}) // export with sourcemaps
		.pipe(sass({
			includePaths: [ // include paths for compiling the files
				'node_modules/'
			]
		})) // compile scss
		.pipe(postcss([autoprefixer, combineq, cssnano])) // use autoprefixer (browser support), combine mediaqueries to one query (great!) and remove the css from trash (comments, spaces, etc.)
		.pipe(dest('dist/assets/css', { sourcemaps: '.'})); // target folder for the compiled file and sourcemaps
}


/**
 * put JS files together and export in temp folder
 * @returns {*}
 */

function concatJsTask() {

	return src(jsFileList, {
		includePaths: [
			'node_modules/'
		]
	})
		.pipe(concat('app.js'))
		.pipe(dest('src/assets/_temp/js'))
}

/**
 * ?
 * @returns {*}
 */

function browserifyTask() {

	return browserify(['src/assets/_temp/js/app.js'])
		.bundle()
		.pipe(source('app.js'))
		.pipe(buffer())
		.pipe(dest('src/assets/_temp/js'))
}


/**
 * Developement Task: Convert to ES5 via Babel and export
 * @returns {*}
 */

function jsDevTask() {

	return src(['src/assets/_temp/js/app.js'], {sourcemaps: true})
		.pipe(babel( {
			presets: ['@babel/preset-env'],
			compact: false
		} ))
		.pipe(dest('dist/assets/js', {sourcemaps: '.'}));
}


/**
 * Production Task: Convert to ES5 via Babel, uglify scripts and export
 * @returns {*}
 */

function jsProdTask() {

	return src(['src/assets/_temp/js/app.js'], {sourcemaps: true})
		.pipe(babel( {
			presets: ['@babel/preset-env']
		} ))
		.pipe(uglify())
		.pipe(dest('dist/assets/js', {sourcemaps: '.'}));

}


/**
 * optimize images from folder
 * @returns {*}
 */

function imageminTask() {

	return src([imageSrc + '/**/*', '!_processed/'])
		.pipe(imagemin([
				imagemin.gifsicle({interlaced: true}),
				imagemin.mozjpeg({quality: 85, progressive: true}),
				imagemin.optipng({optimizationLevel: 5}),
				imagemin.svgo({
					plugins: [
						{removeViewBox: true},
						{cleanupIDs: false}
					]
				})
			]),
			{ verbose: true	}
		)
		.pipe(dest('dist/assets/img/'));

}


/**
 * Cleanup some temporary files
 * @returns {Promise<string[]> | *}
 */

function cleanTask() {

	return del(['src/assets/_temp/'] );
}

function cleanImagesTask() {

	return del(['dist/assets/img/'] );
}

/**
 * generate hash for js and css files --> cache busting / prepend file caching while developement
 * @returns {*}
 */

function cacheBustTask() {

	let cbNumber = new Date().getTime();
	return src('index.html')
		.pipe(replace(/cb=\d+/g, 'cb=' + cbNumber))
		.pipe(dest('.'))
}

/**
 * serve a browsersync server
 * @param cb
 */

function browserSyncServe(cb) {
	browsersync.init({
		proxy: "voodookit.loc",
		notify: true
	});
	cb();
}

/**
 * reload the browser via browsersync
 * @param cb
 */

function browserSyncReload(cb) {
	browsersync.reload();
	cb();
}


/**
 * Gulp generate SVG Sprite
 */

function svgTask() {

	return src('**/*.svg', { cwd: 'src/assets/svg/' })
		.pipe(svgsprite(
			{
				mode: {
					'symbol': {
						'dest': '.',
						'sprite': 'sprite-symbol'
					}
				}
			}
		))
		.pipe(dest('dist/assets/svg'));
}


/**
 * watcher tasks which is looking for changes
 */

function watchTask() {

	// reload when the html file changes
	// watch('*.html', browserSyncReload);

	// run tasks, when scss changes
	watch( [scssSrc + '/**/*.scss'],
	series(
		scssDevTask,
		// cacheBustTask,
		browserSyncReload
	));

	// recompile js when there is a change
	watch( [jsSrc + '/**/*.js'],
	series(
		concatJsTask,
		// browserifyTask,
		jsDevTask,
		// cacheBustTask,
		cleanTask,
		browserSyncReload
	));

	// optimize images if they change
	watch( imageSrc + '/.*',
	series(
		imageminTask,
		browserSyncReload
	));

	watch( 'src/assets/svg/**/*',
	series(
		svgTask
	));

}


/**
 * export the function for usage with gulp default task
 */

exports.default = series(
	parallel(
		imageminTask,
		scssDevTask,
		svgTask
	),
	concatJsTask,
	// browserifyTask,
	jsDevTask,
	// cacheBustTask,
	cleanTask,
	browserSyncServe,
	watchTask
);


/**
 * exports gulp task for production without browsersync and so on
 */

exports.prod = series(
	cleanImagesTask,
	parallel(
		imageminTask,
		scssProdTask,
		svgTask
	),
	concatJsTask,
	// browserifyTask,
	jsProdTask,
	// cacheBustTask,
	cleanTask
);
