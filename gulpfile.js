'use strict';

const { src, dest } = require('gulp');
const sass = require('gulp-dart-sass');

// Style.
function style() {
	return src('./assets/scss/admin.scss')
		.pipe(sass({ outputStyle: 'expanded', indentType: 'tab', indentWidth: 1 }))
		.pipe(dest('./assets/css/'));
}

exports.default = style;
