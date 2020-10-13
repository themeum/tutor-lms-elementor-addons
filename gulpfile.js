var gulp = require("gulp"),
	plumber = require("gulp-plumber"),
	notify = require("gulp-notify"),
	wpPot = require('gulp-wp-pot'),
	clean = require("gulp-clean"),
	zip = require("gulp-zip");

var onError = function (err) {
	notify.onError({
		title: "Gulp",
		subtitle: "Failure!",
		message: "Error: <%= error.message %>",
		sound: "Basso",
	})(err);
	this.emit("end");
};

gulp.task('makepot', function () {
	return gulp
		.src('**/*.php')
		.pipe(plumber({
			errorHandler: onError
		}))
		.pipe(wpPot({
			domain: 'tutor-elementor-addons',
			package: 'Tutor Elementor Addons'
		}))
		.pipe(gulp.dest('languages/tutor-elementor-addons.pot'));
});

/**
 * Build
 */
gulp.task("clean-zip", function () {
	return gulp.src("./tutor-elementor-addons.zip", {
		read: false,
		allowEmpty: true
	}).pipe(clean());
});

gulp.task("clean-build", function () {
	return gulp.src("./build", {
		read: false,
		allowEmpty: true
	}).pipe(clean());
});

gulp.task("copy", function () {
	return gulp
		.src([
			"./**/*.*",
			"!./build/**",
			"!./node_modules/**",
			"!./**/*.zip",
			"!.github",
			"!./gulpfile.js",
			"!./readme.md",
			"!.DS_Store",
			"!./**/.DS_Store",
			"!./LICENSE.txt",
			"!./package.json",
			"!./package-lock.json",
		])
		.pipe(gulp.dest("build/tutor-elementor-addons/"));
});

gulp.task("make-zip", function () {
	return gulp.src("./build/**/*.*").pipe(zip("tutor-elementor-addons.zip")).pipe(gulp.dest("./"));
});

/**
 * Export tasks
 */
exports.build = gulp.series(
	"clean-zip",
	"clean-build",
	"makepot",
	"copy",
	"make-zip",
	"clean-build"
);