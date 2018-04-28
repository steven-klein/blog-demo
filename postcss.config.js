var POSTCSS = {
    "input": "resources/assets/css/app.css",
    "output": "httpdocs/app/themes/site_theme/assets/css/app.css",
    "use": [
        "postcss-import",
        "postcss-cssnext",
        "postcss-browser-reporter",
        "postcss-reporter"
    ],
    "postcss-import": {
        path: [
            "resources/assets/css"
        ]
    },
    "cssnano": {
        safe: true,
        autoprefixer: false //handled by postcss-cssnext
    },
    "local-plugins": true,
    "map": "file"
}

if(process.env.NODE_ENV === "production"){
    POSTCSS.use.push('cssnano'); // add cssnano in production
    POSTCSS.map = false; //sourcemaps to external file
}

module.exports = POSTCSS;
