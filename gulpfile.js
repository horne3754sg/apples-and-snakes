const gulp = require('gulp'),
	autoprefixer = require('gulp-autoprefixer'),
	sourcemaps = require('gulp-sourcemaps'),
	connect = require('gulp-connect-php'),
	sass = require('gulp-ruby-sass'),
	browserSync = require('browser-sync'),
	notify = require('gulp-notify'),
	plumber = require('gulp-plumber');

const config = {
	css: {
		src: './sass/style.scss',
		inputDir: './sass/',
		outputDir: './'
	}
};

const autoprefixerOptions = {
	browsers: ['last 2 versions']
};

// public css
gulp.task('styles', function() {
	return sass(config.css.src, {style: 'compressed', sourcemap: true})
	.pipe(plumber({
		errorHandler: function(err) {
			notify.onError({
				title: 'Gulp error in ' + err.plugin,
				message: err.toString()
			})(err);
		}
	}))
	.pipe(sourcemaps.init())
	.pipe(autoprefixer(autoprefixerOptions))
	.pipe(sourcemaps.write())
	.pipe(sourcemaps.write('maps', {
		includeContent: false,
		sourceRoot: 'source'
	}))
	.pipe(gulp.dest(config.css.outputDir))
	.pipe(browserSync.stream());
});


gulp.task('watch', function() {
	gulp.watch(config.css.src, ['styles']);
	gulp.watch(config.css.inputDir + '/**/*.scss', ['styles']);
});

gulp.task('default', ['styles'], function() {
	gulp.start('watch');
});
