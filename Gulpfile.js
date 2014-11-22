/**
 * Created by jackmolnar1982 on 10/13/14.
 */
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('css', function(){
    gulp.src('app/assets/sass/main_styles.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 10 versions'))
        .pipe(gulp.dest('public/css'));
});

gulp.task('watch', function(){
    gulp.watch('app/assets/sass/**/*.scss', ['css']);
});

gulp.task('default', ['watch']);