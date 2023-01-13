const {src, dest, watch, series } = require('gulp');
const gulp = require('gulp');
const sassCompiler = require('gulp-sass')(require('sass'));
const minifyCss = require('gulp-clean-css')
const sourcesMaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

sassCompiler.compiler = require('node-sass');

gulp.task('bundleSass', () => {
    return gulp.src([
        './resources/scss/**/*.scss',
        './resources/css/**/*.css'
    ])
        .pipe(sourcesMaps.init())
        .pipe(sassCompiler().on('error', sassCompiler.logError))
        .pipe(minifyCss())
        .pipe(sourcesMaps.write())
        .pipe(concat('styles.min.css'))
        .pipe(dest('./resources/build/css/'))
});

gulp.task('bundleSassFrontend', () => {
    return gulp.src([
        './resources/scss/front/**/*.scss',
    ])
        .pipe(sourcesMaps.init())
        .pipe(sassCompiler().on('error', sassCompiler.logError))
        .pipe(minifyCss())
        .pipe(sourcesMaps.write())
        .pipe(concat('front.min.css'))
        .pipe(dest('./resources/build/css/'))
});

gulp.task('bundleJs', () => {
    return gulp.src([
        './resources/js/**/*.js'
    ])
        .pipe(uglify())
        .pipe(concat('app.min.js'))
        .pipe(gulp.dest('./resources/build/js/'))
});

gulp.task('bundleJsFrontend', () => {
    return gulp.src([
        './resources/js/front/**/*.js'
    ])
        .pipe(uglify())
        .pipe(concat('front.min.js'))
        .pipe(gulp.dest('./resources/build/js/'))
});

gulp.task('dev', function() {
    watch('./resources/scss/**/*.scss', gulp.series('bundleSass'));
    watch('./resources/scss/front/**/*.scss', gulp.series('bundleSassFrontend'));
    watch('./resources/css/**/*.css', gulp.series('bundleSass'));
    watch('./resources/js/**/*.js', gulp.series('bundleJs'));
    watch('./resources/js/front/**/*.js', gulp.series('bundleJsFrontend'));
});

exports.bundleSass = 'bundleSass';
exports.default = series('dev');