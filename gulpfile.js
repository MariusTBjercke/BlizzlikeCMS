'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifyCSS = require('gulp-minify-css');
var rename = require('gulp-rename');
var minify = require('gulp-minify');

// Minifies JS
gulp.task('minimize-js', function(){
    return gulp.src('assets/js/*.js')
        .pipe(uglify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('js'))
});

// SCSS for Legion
gulp.task('minimize-scss', function(){
    return gulp.src('assets/scss/main.scss')
        .pipe(sass())
        .pipe(concat('main.min.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('css'))
});

// SCSS for Legion
gulp.task('minimize-legion', function(){
    return gulp.src('assets/scss/legion/**/*.scss')
        .pipe(sass())
        .pipe(concat('legion.min.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('css'))
});

// SCSS for WoTLK
gulp.task('minimize-wotlk', function(){
    return gulp.src('assets/scss/wotlk/**/*.scss')
        .pipe(sass())
        .pipe(concat('wotlk.min.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('css'))
});

// SCSS for Bootstrap
gulp.task('minimize-bootstrap', function(){
    return gulp.src('includes/bootstrap/bootstrap.css')
        .pipe(concat('bootstrap.min.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('css'))
});

// SCSS for admin
gulp.task('minimize-admin', function(){
    return gulp.src('assets/scss/admin/**/*.scss')
        .pipe(sass())
        .pipe(concat('admin.min.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('css'))
    
});

// Minimize install CSS
gulp.task('minimize-login', function(){
    return gulp.src('assets/install.css')
        .pipe(minifyCSS())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('css'))
});

// Watch the provided directories for changes and run tasks
gulp.task('watcher', function(){
    gulp.watch('./assets/scss/*.scss', ['minimize-scss']);
    gulp.watch('./assets/scss/legion/*.scss', ['minimize-legion']);
    gulp.watch('./assets/scss/wotlk/*.scss', ['minimize-wotlk']);
    gulp.watch('./includes/bootstrap/bootstrap.css', ['minimize-bootstrap']);
    gulp.watch('./assets/scss/admin/*.scss', ['minimize-admin']);
    gulp.watch('./assets/install.css', ['minimize-login']);
    gulp.watch('./assets/js/*.js', ['minimize-js']);
});

// Default task - you can simply type "gulp" in your terminal to start the watcher
gulp.task('default', ['watcher']);