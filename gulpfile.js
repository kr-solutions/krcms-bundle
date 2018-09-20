// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var merge = require('gulp-merge');

// Directory configuration
var config = {
    nodeDir: './node_modules',
    distDir: './Resources/public/dist'
};

// Compile Our Styles
gulp.task('internal-styles', function () {
    var cssStream = gulp.src('Resources/public/css/**/*.css');

    var sassStream = gulp.src('Resources/public/scss/**/*.scss')
            .pipe(sass());

    return merge(cssStream, sassStream)
            .pipe(concat('app.css'))
            .pipe(rename('app.min.css'))
            .pipe(uglifycss())
            .pipe(gulp.dest(config.distDir + '/css'))
            ;
});

// Concatenate & Minify JS
gulp.task('internal-scripts', function () {
    return gulp.src('Resources/public/js/**/*.js')
            .pipe(concat('app.js'))
            .pipe(rename('app.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest(config.distDir + '/js'));
});

// Compile Vendor Styles
gulp.task('vendor-styles', function () {
    return gulp.src([
        config.nodeDir + '/font-awesome/css/font-awesome.css',
        config.nodeDir + '/bootstrap/dist/css/bootstrap.min.css',
        config.nodeDir + '/bootstrap/dist/css/bootstrap-theme.min.css'
    ])
            .pipe(concat('vendor.css'))
            .pipe(rename('vendor.min.css'))
            .pipe(uglifycss())
            .pipe(gulp.dest(config.distDir + '/css'));
});

// Concatenate & Minify Vendor
gulp.task('vendor-scripts', function () {
    return gulp.src([
        config.nodeDir + '/jquery/dist/jquery.min.js',
        config.nodeDir + '/jquery-migrate/dist/jquery-migrate.min.js',
        config.nodeDir + '/bootstrap/dist/js/bootstrap.min.js',
        config.nodeDir + '/tablednd/dist/jquery.tablednd.min.js'
    ])
            .pipe(concat('vendor.js'))
            .pipe(rename('vendor.min.js'))
            .pipe(uglify())
            .pipe(gulp.dest(config.distDir + '/js'));
});

// Images
gulp.task('images', function () {
    return gulp.src([
        'Resources/public/img/**/*.*'
    ]).pipe(gulp.dest(config.distDir + '/img'));
});

// Icons
gulp.task('icons', function () {
    return gulp.src([
        config.nodeDir + '/font-awesome/fonts/**.*',
        config.nodeDir + '/bootstrap/dist/fonts/**.*'
    ]).pipe(gulp.dest(config.distDir + '/fonts'));
});

// Patterns
gulp.task('patterns', function () {
    return gulp.src([
        'Resources/public/patterns/**/*.*'
    ]).pipe(gulp.dest(config.distDir + '/css/patterns'));
});

// Watch Files For Changes
gulp.task('watch', function () {
    gulp.watch('Resources/public/js/**/*.js', ['internal-scripts']);
    gulp.watch('Resources/public/css/**/*.css', ['internal-styles']);
    gulp.watch('Resources/public/scss/**/*.scss', ['internal-styles']);
    gulp.watch('Resources/public/patterns/**.*', ['patterns']);
});

// Default Task
gulp.task('default', ['internal-styles', 'internal-scripts', 'images', 'icons', 'patterns', 'vendor-styles', 'vendor-scripts', 'watch']);
