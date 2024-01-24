'use strict';

const { src, dest, parallel } = require('gulp');
const sass = require('gulp-dart-sass');
const merge = require('merge-stream');

// Style.
function style() {
	var theme = src('./assets/scss/style.scss')
		.pipe(sass({ outputStyle: 'expanded', indentType: 'tab', indentWidth: 1 }))
        .pipe(dest('./assets/css/'));

	var admin = src('./assets/scss/admin.scss')
		.pipe(sass({ outputStyle: 'expanded', indentType: 'tab', indentWidth: 1 }))
		.pipe(dest('./assets/css/'));

	return merge(theme, admin);
}

exports.default = parallel(style);
