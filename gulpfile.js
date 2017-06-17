// ////////////////////////////////////////////////////
// Required 
// ////////////////////////////////////////////////////

var gulp = require('gulp'),
	uglify = require('gulp-uglify'),
	rename = require('gulp-rename'),
	autoprefixer = require('gulp-autoprefixer'),
	sass = require('gulp-sass'),
	browserSync = require('browser-sync'),
	cleanCSS = require('gulp-clean-css'),
	reload = browserSync.reload;

var autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};

// ////////////////////////////////////////////////////
// Scripts 
// ////////////////////////////////////////////////////

gulp.task('scripts', function(){
	gulp.src(['public/js/*.js',
			 '!public/js/*.min.js'])
		.pipe(rename({suffix:'.min'}))
		.pipe(uglify())
		.pipe(gulp.dest('public/js'))
		.pipe(reload({stream:true}));
});

// ////////////////////////////////////////////////////
// Sass 
// ////////////////////////////////////////////////////

gulp.task('sass', function(){
	gulp.src('resources/assets/sass/*.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(autoprefixer(autoprefixerOptions))
		.pipe(gulp.dest('public/css/'))
		//after compiling and storing the sass to css pipe the files for minifying.
		.pipe(rename({suffix:'.min'}))
		.pipe(cleanCSS({compatibility: 'ie8'}))
		.pipe(gulp.dest('public/css/'))
		.pipe(reload({stream:true})); 
	
});
 
// ////////////////////////////////////////////////////
// Html 
// ////////////////////////////////////////////////////

gulp.task('html', function(){
	gulp.src('resources/views/**/*.blade.php')
	.pipe(reload({stream:true}));
});

// ////////////////////////////////////////////////////
// Browser-Sync 
// ////////////////////////////////////////////////////

gulp.task('browser-sync', function(){
	browserSync({  
		proxy: "localhost:8000"

	});
});


// ////////////////////////////////////////////////////
// Watch 
// ////////////////////////////////////////////////////

gulp.task('watch', function(){
	gulp.watch('public/js/*.js', ['scripts'])
	gulp.watch('resources/assets/sass/*.scss', ['sass'])
	gulp.watch('resources/views/**/*.blade.php', ['html'])
});

// ////////////////////////////////////////////////////
// Default Task 
// ////////////////////////////////////////////////////

gulp.task('default', ['scripts', 'sass', 'html', 'browser-sync', 'watch']);