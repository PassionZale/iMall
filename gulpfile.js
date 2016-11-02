'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('mixsass',function(){
    return gulp.src('resources/assets/sass/admin.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('public/css/'));
});

gulp.task('watchsass',function () {
    gulp.watch('resources/assets/sass/*.scss',['mixsass']);
});