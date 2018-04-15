//引入gulp
var gulp = require('gulp');

//引入外掛
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer');
var minifyCSS = require('gulp-csso');
var rename = require('gulp-rename');
var babel = require('gulp-babel');
var uglify = require('gulp-uglify');

//建立任務
//轉譯sass、合併、autoprefix、壓縮css
gulp.task('convertCSS', function(){
    return gulp.src('./**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('./all.css'))
        .pipe(autoprefixer({
            browsers: ['last 2 versions', 'Android >= 4.0'],
            cascade: true, 
            remove:true 
        }))
        .pipe(minifyCSS())
        .pipe(rename(function(path) {
            path.basename += ".min";
            path.extname = ".css";
          }))
        .pipe(gulp.dest('./build/css'));
  })

//編譯並壓縮js
gulp.task('convertJS', function(){
    return gulp.src('./**/*.js')
      .pipe(babel({ presets: ['es2015'] }))
      .pipe(uglify())
      .pipe(rename(function(path) {
        path.basename += ".min";
        path.extname = ".js";
    }))
      .pipe(gulp.dest('./build/js'))
  })

//監聽文件變化，自動執行任務
gulp.task('watch', function(){
    gulp.watch('./**/*.scss', ['convertCSS']);
    gulp.watch('./**/*.js', ['convertJS']);
  })


gulp.task('default', ['convertJS', 'convertCSS', 'watch']);