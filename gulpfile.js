/*
 * Copyright 2015-2016 Adrien Navratil
 *
 * This file is part of S-Update-Server.
 *
 * S-Update-Server is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * S-Update-Server is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with S-Update-Server.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Litarvan's GULP build script v1.0
 *
 * Copyright (c) 2015 Adrien Navratil
 * Under the GPL-3 license, see <http://www.gnu.org/licenses/>.
 */

// Settings

const PROJECT_NAME = "S-Update-Server";
const PROJECT_VERSION = "3.2.0-BETA (By Litarvan)";
const PROJECT_DESC = "The complete updating system";
const PROJECT_CR = "Copyright (c) 2015-2016 Adrien Navratil";

const SOURCES_FOLDER = 'src';
const RESOURCES_FOLDER = 'resources';
const COFFEE_FOLDER = RESOURCES_FOLDER + '/coffee';
const SASS_FOLDER = RESOURCES_FOLDER + '/sass';
const IMAGES_FOLDER = RESOURCES_FOLDER + '/images';
const VIEWS_FOLDER = 'views';

const BUILD_FOLDER = 'build';
const COMPILED_FOLDER = BUILD_FOLDER + '/compiled';
const MINIMIZED_FOLDER = BUILD_FOLDER + '/minimized';
const TEST_FOLDER = BUILD_FOLDER + '/test';
const DIST_FOLDER = BUILD_FOLDER + '/dist';
const BUILD_BASE = 'core';

const COMPILED_COFFEE_FOLDER = COMPILED_FOLDER + '/js';
const COMPILED_SASS_FOLDER = COMPILED_FOLDER + '/css';

const MINIMIZED_JS_FOLDER = MINIMIZED_FOLDER + '/js';
const MINIMIZED_CSS_FOLDER = MINIMIZED_FOLDER + '/css';
const MINIMIZED_IMAGES_FOLDER = MINIMIZED_FOLDER + '/images';

const TEST_RESOURCES_FOLDER = TEST_FOLDER + '/resources';
const TEST_IMAGES_FOLDER = TEST_RESOURCES_FOLDER + '/images';
const TEST_JS_FOLDER = TEST_RESOURCES_FOLDER + '/js';
const TEST_CSS_FOLDER = TEST_RESOURCES_FOLDER + '/css';
const TEST_SOURCE_FOLDER = TEST_FOLDER + '/src';
const TEST_VIEWS_FOLDER = TEST_FOLDER + '/views';

const DIST_RESOURCES_FOLDER = DIST_FOLDER + '/resources';
const DIST_SOURCE_FOLDER = DIST_FOLDER + '/src';
const DIST_VIEWS_FOLDER = DIST_FOLDER + '/views';

const COFFEE_SETTINGS = { bare: true };
const COMPASS_SETTINGS = { css: COMPILED_SASS_FOLDER, sass: 'resources/sass', image: IMAGES_FOLDER };

const ARCHIVE_NAME = PROJECT_NAME + '-3.2.0-BETA.zip';

// Modules & Hello

var gutil = require('gulp-util');

gutil.log("");
gutil.log(PROJECT_NAME + " - " + PROJECT_VERSION);
gutil.log(PROJECT_DESC);
gutil.log("");
gutil.log(PROJECT_CR);
gutil.log("");
gutil.log("");
gutil.log("Powered by Litarvan's GULP build script - Copyright (c) 2015-2016 Adrien Navratil");
gutil.log("");
gutil.log("Loading modules...");

var gulp = require('gulp');
var coffee = require('gulp-coffee');
var compass = require('gulp-compass');
var livereload = require('gulp-livereload');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-minify-css');
//var imagemin = require('gulp-imagemin');
var del = require('del');
var zip = require('gulp-zip');
var composer = require('gulp-composer');

gutil.log("Loading script...");

// Tasks

// Meta tasks

gulp.task('default', ['dist'], function() {});
gulp.task('compile', ['compile-coffee', 'compile-sass', 'compile-images'], function() {});
gulp.task('minimize', ['minimize-js', 'minimize-css', 'minimize-images'], function() {});
gulp.task('test', ['test-prepare', 'composer-test'], function() {});
gulp.task('clean', ['clean-test', 'clean-dist', 'clean-compile', 'clean-minimize'], function() {});

// Compile tasks

gulp.task('compile-coffee', function()
{
    return gulp.src(COFFEE_FOLDER + '/**/*.coffee')
        .pipe(coffee(COFFEE_SETTINGS))
        .pipe(gulp.dest(COMPILED_COFFEE_FOLDER));
});

gulp.task('compile-sass', function()
{
    return gulp.src(SASS_FOLDER + '/**/*.scss')
        .pipe(compass(COMPASS_SETTINGS));
});

// Minimize tasks

gulp.task('minimize-js', ['compile-coffee'], function()
{
    return gulp.src(COMPILED_COFFEE_FOLDER + '/**/*.js')
        .pipe(uglify())
        .pipe(gulp.dest(MINIMIZED_JS_FOLDER));
});

gulp.task('minimize-css', ['compile-sass'], function()
{
    return gulp.src(COMPILED_SASS_FOLDER + '/*.css')
        .pipe(minifyCss())
        .pipe(gulp.dest(MINIMIZED_CSS_FOLDER));
});

gulp.task('minimize-images', function()
{
    return gulp.src(IMAGES_FOLDER + '/**/*.png')
        //.pipe(imagemin())
        .pipe(gulp.dest(MINIMIZED_IMAGES_FOLDER));
});

// Test tasks
gulp.task('test-prepare', ['test-php', 'test-coffee', 'test-sass', 'test-views', 'test-images'], function()
{
    return gulp.src(makePath(BUILD_BASE))
        .pipe(gulp.dest(TEST_FOLDER));
});

gulp.task('test-images', function()
{
    return gulp.src(IMAGES_FOLDER + '/**/*.png')
        .pipe(gulp.dest(TEST_IMAGES_FOLDER));
});

gulp.task('test-php', function()
{
    gulp.src(SOURCES_FOLDER + '/apps/**/*.php')
        .pipe(gulp.dest(TEST_FOLDER + '/apps/'));
 
    gulp.src(SOURCES_FOLDER + '/check-methods/**/*.php')
        .pipe(gulp.dest(TEST_FOLDER + '/check-methods/'));
 
    return gulp.src(SOURCES_FOLDER + '/main/**/*.php')
        .pipe(gulp.dest(TEST_SOURCE_FOLDER));
});

gulp.task('test-coffee', ['compile-coffee'], function()
{
    return gulp.src(COMPILED_COFFEE_FOLDER + '/**/*.js')
        .pipe(gulp.dest(TEST_JS_FOLDER));
});

gulp.task('test-sass', ['compile-sass'], function()
{
    return gulp.src(COMPILED_SASS_FOLDER + '/*.css')
        .pipe(gulp.dest(TEST_CSS_FOLDER));
});

gulp.task('test-views', function()
{
    return gulp.src(VIEWS_FOLDER + '/**/*')
        .pipe(gulp.dest(TEST_VIEWS_FOLDER));
});

gulp.task('test-images', function()
{
    return gulp.src(IMAGES_FOLDER + '/**/*.png')
        .pipe(gulp.dest(TEST_IMAGES_FOLDER));
});

gulp.task('watch', ['test'], function()
{
    gulp.watch(IMAGES_FOLDER + '/**/*.png', ['test-images'])
    gulp.watch(COFFEE_FOLDER + '/**/*.coffee', ['test-coffee']);
    gulp.watch(SASS_FOLDER + '/**/*.scss', ['test-sass']);
    gulp.watch(SOURCES_FOLDER + '/**/*.php', ['test-php']);
    gulp.watch(VIEWS_FOLDER + '/**/*', ['test-views']);

    return gulp.watch([TEST_CSS_FOLDER + '/**/*.css', TEST_JS_FOLDER + '/**/*.js', TEST_VIEWS_FOLDER + '/**/*']).on('change', function(event)
    {
        gutil.log('[' + PROJECT_NAME + '] Updated file ' + event.path + ' with livereload');
        livereload.reload(event.path);
    });
});

// Clean tasks

gulp.task('clean-test', function()
{
    return del(TEST_FOLDER);
});

gulp.task('clean-dist', function()
{
    return del(DIST_FOLDER);
});

gulp.task('clean-compile', function()
{
    return del(COMPILED_FOLDER);
});

gulp.task('clean-minimize', function()
{
    return del(MINIMIZED_FOLDER);
});

// Dist tasks

gulp.task('dist-prepare-base', function()
{
    return gulp.src(makePath(BUILD_BASE))
        .pipe(gulp.dest(DIST_FOLDER));
});

gulp.task('dist-prepare-php', function()
{
    gulp.src(SOURCES_FOLDER + '/apps/**/*.php')
        .pipe(gulp.dest(DIST_FOLDER + '/apps/'));
 
    gulp.src(SOURCES_FOLDER + '/check-methods/**/*.php')
        .pipe(gulp.dest(DIST_FOLDER + '/check-methods/'));
 
    return gulp.src(SOURCES_FOLDER + '/main/**/*.php')
        .pipe(gulp.dest(DIST_SOURCE_FOLDER));
});

gulp.task('dist-prepare-views', function()
{
    return gulp.src(VIEWS_FOLDER + '/**/*')
        .pipe(gulp.dest(DIST_VIEWS_FOLDER));
});

gulp.task('dist-prepare', ['minimize', 'dist-prepare-base', 'dist-prepare-php', 'dist-prepare-views'], function()
{
    return gulp.src(makePath(MINIMIZED_FOLDER))
        .pipe(gulp.dest(DIST_RESOURCES_FOLDER));
});

gulp.task('dist', ['dist-prepare', 'composer-dist'], function()
{
    return gulp.src(makePath(DIST_FOLDER))
        .pipe(zip(ARCHIVE_NAME))
        .pipe(gulp.dest(BUILD_FOLDER));
});

// Composer tasks

gulp.task('composer-dist', ['dist-prepare'], function () {
	return composer('update', { cwd: DIST_FOLDER, bin: 'composer' });
});

gulp.task('composer-test', ['test-prepare'], function () {
	return composer('update', { cwd: TEST_FOLDER, bin: 'composer' });
});

// Usefull methods

function makePath(thePath)
{
    return [thePath + '/**/*', thePath + '/**/.*'];
}

gutil.log("  -> OK !");
gutil.log("");
