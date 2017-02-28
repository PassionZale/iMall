'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

// admin.css
gulp.task('admin-sass',function(){
    return gulp.src('resources/assets/sass/admin.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('public/css/'));
});

// mall.css
gulp.task('mall-sass',function(){
    return gulp.src('resources/assets/sass/mall.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('public/css/'));
});

// global.css
gulp.task('global-sass',function(){
    return gulp.src('resources/assets/sass/global.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('public/css/'));
});

// gulp watch
gulp.task('watchsass',function () {
    return gulp.watch('resources/assets/sass/*.scss',['admin-sass','mall-sass','global-sass']);
});