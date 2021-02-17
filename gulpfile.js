// Load variables from gulp for easier use
const { src, dest, watch, series, parallel } = require('gulp');

// SCSS Workflow
const sass = require('gulp-sass');
const sassVariables = require('gulp-sass-variables');
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

// String replacement for cache custing task
const replace = require('gulp-replace');

// Browsersync
const browsersync = require('browser-sync').create();

// Roomcleaner
const del = require('del');

// for iconfont generator
const svgmin = require('gulp-svgmin');
const iconfont = require('gulp-iconfont');
const iconfontCss = require('gulp-iconfont-css');

// define some folders
const scssSrc = 'src/assets/scss';
const jsSrc = 'src/assets/js';
const svgSrc  = 'src/assets/svg'
const imageSrc = 'img';


function minifySVG() {

	return src(svgSrc + '/*.svg')
		.pipe(svgmin())
		.pipe(dest(svgSrc + '/minified') )

}

/**
 * Compile the SCSS files to CSS file
 * @returns {*}
 */

function scssDevTask() {

	return src([scssSrc + '/app.scss', scssSrc + '/gutenberg.scss'], {sourcemaps: true}) // export with sourcemaps
		.pipe(sassVariables({/**/
			$last_changes: Date.now()
		}))
		.pipe(sass({

			includePaths: [ // include paths for compiling the file/**/s
				'node_modules'
			]
		})) // compile scss
		.pipe(postcss([autoprefixer])) // use autoprefixer (browser support), combine mediaqueries to one query (great!) and remove the css from trash (comments, spaces, etc.)
		.pipe(dest('public/css', { sourcemaps: '.'})); // target folder for the compiled file and sourcemaps
}


/**
 * compile scss files
 * @returns {*}
 */

function scssProdTask() {

	return src([scssSrc + '/app.scss', scssSrc + '/gutenberg.scss'], {sourcemaps: true}) // export with sourcemaps
		.pipe(sassVariables({/**/
			$last_changes: Date.now()
		}))
		.pipe(sass({
			includePaths: [ // include paths for compiling the files
				'node_modules'
			]
		})) // compile scss
		.pipe(postcss([autoprefixer, combineq, cssnano])) // use autoprefixer (browser support), combine mediaqueries to one query (great!) and remove the css from trash (comments, spaces, etc.)
		.pipe(dest('public/css', { sourcemaps: '.'})); // target folder for the compiled file and sourcemaps
}


/**
 * put JS files together and export in temp folder
 * @returns {*}
 */

function concatJsTask() {

	return src([jsSrc + '/**/*.js'])
		.pipe(concat('scripts.js'))
		.pipe(dest('app/_temp/js'))
}

/**
 * ?
 * @returns {*}
 */

function browserifyTask() {

	return browserify('app/_temp/js/scripts.js')
		.bundle()
		.pipe(source('scripts.js'))
		.pipe(buffer())
		.pipe(dest('app/_temp/js'))
}


/**
 * Developement Task: Convert to ES5 via Babel and export
 * @returns {*}
 */

function jsDevTask() {

	return src(['app/_temp/js/scripts.js'], {sourcemaps: true})
		.pipe(babel( {
			presets: ['@babel/preset-env']
		} ))
		.pipe(dest('public/js', {sourcemaps: '.'}));
}


/**
 * Production Task: Convert to ES5 via Babel, uglify scripts and export
 * @returns {*}
 */

function jsProdTask() {

	return src(['app/_temp/js/scripts.js'], {sourcemaps: true})
		.pipe(babel( {
			presets: ['@babel/preset-env']
		} ))
		.pipe(uglify())
		.pipe(dest('public/js', {sourcemaps: '.'}));

}


/**
 * optimize images from folder
 * @returns {*}
 */

function imageminTask() {

	return src([imageSrc + '/*', '!_processed/'])
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
		.pipe(dest('public/img/'));

}


/**
 * Cleanup some temporary files
 * @returns {Promise<string[]> | *}
 */

function cleanTask() {

	return del(['app/_temp/'] )
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
		server: {
			baseDir: '.'
		}
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

function generateIcons() {

	const fontName = 'space_icon';
	return src([svgSrc + '/*.svg'])
		.pipe(iconfontCss({
			fontName: fontName,
			path: scssSrc + '/templates/_icons_template.scss',
			targetPath: './../scss/_icons.scss',
			fontPath: '../fonts/generated/'
		}))
		.pipe(iconfont({
			fontName: fontName,
			formats: ['svg', 'ttf', 'eot', 'woff', 'woff2'],
			normalize: true
		}))
		.pipe(dest('app/_temp/fonts/generated'))
}

/**
 * move generated scss files in destination folder
 * @returns {*}
 */

function moveGeneratedScss() {

	return src('app/_temp/fonts/scss/*.scss')
		.pipe(dest(scssSrc + '/generated', {
			overwrite: true
		}))
}

/**
 * move generated icon fontfile to distribution folder
 * @returns {*}
 */

function moveGeneratedIcons() {
	return src('app/_temp/fonts/generated/*.*')
		.pipe(dest('public/fonts/generated/', {
			overwrite: true
		}))
}

function copyImageAssets() {
	return src('src/assets/img/*.*')
		.pipe(dest('public/img', {
			overwrite: true
		}))
}


/**
 * watcher tasks which is looking for changes
 */

function watchTask() {

	// reload when the html file changes
	// watch('*.html', browserSyncReload);

	// run tasks, when scss changes
	watch(['src/assets/scss/**/*.scss'],
		series(
			scssDevTask,
			// cacheBustTask,
			// browserSyncReload
		));

	// recompile js when there is a change
	watch(['src/assets/js/**/*.js'],
		series(
			concatJsTask,
			browserifyTask,
			jsDevTask,
			// cacheBustTask,
			cleanTask,
			// browserSyncReload
		));

	// optimize images if they change
	// watch('src/assets/img/**/.*', series(
	// 	imageminTask,
	// 	browserSyncReload
	// ))

	// look for new svgs, render new version of font
	watch(['src/assets/svg/*.svg'],
		series(
			minifySVG,
			generateIcons,
			moveGeneratedScss,
			moveGeneratedIcons,
			scssDevTask,
			cleanTask,
		));
}


/**
 * export the function for usage with gulp default task
 */

exports.default = series(
	minifySVG,
	generateIcons,
	moveGeneratedScss,
	moveGeneratedIcons,
	parallel(
		// imageminTask,
		copyImageAssets,
		scssDevTask
	),
	concatJsTask,
	browserifyTask,
	jsDevTask,
	// cacheBustTask,
	cleanTask,
	// browserSyncServe,
	watchTask
);


/**
 * exports gulp task for production without browsersync and so on
 */

exports.prod = series(
	minifySVG,
	generateIcons,
	moveGeneratedScss,
	moveGeneratedIcons,
	parallel(
		// imageminTask,
		copyImageAssets,
		scssProdTask
	),
	concatJsTask,
	browserifyTask,
	jsProdTask,
	// cacheBustTask,
	cleanTask
);


/**
 * export gulp task for iconfont generation
 */

exports.iconfont = series(
	minifySVG,
	generateIcons,
	moveGeneratedScss,
	moveGeneratedIcons,
	cleanTask
);


/**
 * export gulp task for scss/sass compilation
 */
exports.sass = series(
	scssDevTask
)
