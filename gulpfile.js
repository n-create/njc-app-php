const gulp = require("gulp");
const jade = require("gulp-jade");
const rename = require("gulp-rename");
const typescript = require("gulp-typescript");
const watch = require("gulp-watch");
const changed = require("gulp-changed");
const compass = require("gulp-sass")(require("sass"));

gulp.task("jade", () => {
  gulp
    .src(["./resources/assets/jade/**/*.jade"])
    .pipe(changed("./resources/views/", { extension: ".php" }))
    .pipe(
      jade({
        pretty: true,
      })
    )
    .pipe(
      rename({
        extname: ".php",
      })
    )
    .pipe(gulp.dest("./resources/views/"));
});

gulp.task("typescript", () => {
  gulp
    .src("./resources/assets/ts/**/*.ts")
    .pipe(changed("./public/js/", { extension: ".js" }))
    .pipe(
      typescript({
        allowJs: true,
      })
    )
    .pipe(gulp.dest("./public/js/"));
});

gulp.task("compass", () => {
  gulp
    .src("./resources/assets/sass/**/*.scss")
    .pipe(
      compass({
        outputStyle: "expanded",
        sourceComments: true,
      }).on("error", compass.logError)
    )
    .pipe(gulp.dest("./public/css/"));
});

gulp.task("watch", () => {
  gulp
    .watch(["resources/assets/jade/**/*.jade"], gulp.task("jade"))
    .on("change", (e) => {
      console.log(e.path);
    });
  gulp.watch(
    ["resources/assets/ts/**/*.ts", "typings/**/**.ts"],
    gulp.task("typescript"),
    (e) => {
      console.log(e.path);
    }
  );
  gulp.watch(["resources/assets/sass/**/*.scss"], gulp.task("compass"), (e) => {
    console.log(e.path);
  });
});

gulp.task("default", gulp.parallel("jade", "typescript", "compass", "watch"));
gulp.task("deploy", gulp.parallel("jade", "typescript", "compass"));
