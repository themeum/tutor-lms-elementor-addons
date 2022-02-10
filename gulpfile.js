var gulp = require("gulp"),
	plumber = require("gulp-plumber"),
	sass = require("gulp-sass")(require('sass')),
	notify = require("gulp-notify"),
	wpPot = require('gulp-wp-pot'),
	clean = require("gulp-clean"),
	rename = require("gulp-rename"),
	sourcemaps = require("gulp-sourcemaps"),
	zip = require("gulp-zip");

	package = require('./package.json'); 

const { watch } = require('gulp');
const cleanCSS = require('gulp-clean-css');

var tasks = {
	tutor_elementor_min: {src: "assets/css/tutor-elementor.css", mode: 'compressed', destination: 'tutor-elementor.min.css'},
	tutor_elementor_icon: {src: "assets/css/tutor-elementor-icons.css", mode: 'compressed', destination: 'tutor-elementor-icons.min.css'},
};

var task_keys = Object.keys(tasks);

for(let task in tasks) {

    let blueprint = tasks[task];
    
    gulp.task(task, function () {
        return gulp
			.src(blueprint.src)
			.pipe(plumber({
				errorHandler: onError
			}))
			.pipe(sass({
				outputStyle: blueprint.mode
			}))
			.pipe(rename(blueprint.destination))
			.pipe(sourcemaps.write("."))
			.pipe(gulp.dest("assets/css"));        
    });
}

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
			domain: 'tutor-lms-elementor-addons',
			package: 'Tutor LMS Elementor Addons'
		}))
		.pipe(gulp.dest('languages/tutor-lms-elementor-addons.pot'));
});

/**
 * Build
 */
gulp.task("clean-zip", function () {
	return gulp.src("./tutor-lms-elementor-addons.zip", {
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
			"!./README.md",
			"!.DS_Store",
			"!./**/.DS_Store",
			"!./LICENSE.txt",
			"!./package.json",
			"!./package-lock.json",
		])
		.pipe(gulp.dest("build/tutor-lms-elementor-addons/"));
});

gulp.task("make-zip", function () {
	return gulp.src("./build/**/*.*").pipe(zip(`tutor-lms-elementor-addons-v${package.version}.zip`)).pipe(gulp.dest("./"));
});

gulp.task('minify-css', () => {
	return gulp.src('assets/css/tutor-elementor.css')
	  .pipe(cleanCSS({debug: true}, () => {
	  }))
	.pipe(gulp.dest('assets/css'));
});

gulp.task("watch", function() {
	watch('assets/css/tutor-elementor.css', gulp.series(...task_keys));
	watch('assets/css/tutor-elementor-icons.css', gulp.series(...task_keys));
});
/**
 * Export tasks
 */

exports.build = gulp.series(
	"clean-zip",
	"clean-build",
	"makepot",
	"copy",
	"make-zip"
);