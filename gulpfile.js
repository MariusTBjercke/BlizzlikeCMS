var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');

gulp.task('minify', () => {
    return gulp.src('css/*.css')
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('min'));
});

gulp.task('watch', function() {
    gulp.watch('./css/*.css', ['minify']);
});

gulp.task('default', ['minify', 'watch']);