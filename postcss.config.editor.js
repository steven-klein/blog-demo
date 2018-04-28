var POSTCSS = require('./postcss.config');

POSTCSS.input = "resources/assets/css/editor-style.css";
POSTCSS.output = "httpdocs/app/themes/site_theme/assets/css/editor-style.css";
delete POSTCSS.cssnano;

module.exports = POSTCSS;
