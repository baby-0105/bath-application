// gulpプラグインの読み込み
const gulp = require("gulp");
// Sassをコンパイルするプラグインの読み込み
var sass = require('gulp-sass')(require('sass'));
// SCSSをまとめて読み込むプラグインの読み込み
var sassGlob = require("gulp-sass-glob");

// style.scssをタスクを作成する
gulp.task("default", function() {
  // style.scssファイルを取得
  return (
    gulp
      .src("sass/app.scss", { allowEmpty: true })
      // Sassのコンパイルを実行
      .pipe(
        sass({
          outputStyle: "expanded"
        })
      )
      //SCSSをまとめ読み込むことを許可する
      .pipe(sassGlob())
      // cssフォルダー以下に保存
      .pipe(gulp.dest("public/css"))
  );
});
