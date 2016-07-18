var gulp = require('gulp');
var imagemin = require('gulp-imagemin');
var webpack = require('webpack-stream');
var pug = require('gulp-pug');
var paths = {
    img: ['origin/imgs/*', 'public/imgs'],
    entry: ['origin/entry/*.js', 'public/build'],
    pug:['views/*.pug','./']
};
gulp.task('img', function () {
    return gulp.src(paths.img[0])
        .pipe(imagemin({optimizationLevel: 5}))
        .pipe(gulp.dest(paths.img[1]));
});
gulp.task('entry', function () {
    return gulp.src(paths.entry[0])
        .pipe(webpack(require('./webpack.config.js')))
        .pipe(gulp.dest(paths.entry[1]));
});
gulp.task('pug', function () {
    return gulp.src(paths.pug[0])
        .pipe(pug({pretty: true}))
        .pipe(gulp.dest(paths.pug[1]));
});
gulp.task('watch', function () {
    gulp.watch("origin/sass/**/*.scss", ['entry']);
    gulp.watch("origin/js/*.js", ['entry']);
    gulp.watch(paths.entry[0], ['entry']);
    gulp.watch("views/**/*.pug", ['pug']);
});
gulp.task('default', ['watch']);