let env = require('dotenv').config({
    silent: true
});

module.exports = {
    "notify": process.env.BROWSERSYNC_NOTIFY || true,
    "proxy": process.env.BROWSERSYNC_PROXY || false,
    "files": [
        "httpdocs/**/*.+(css|js|html|php)",
        "config/**/*.+(css|js|html|php)"
    ],
    "watchOptions": {},
    "ghostMode": {
        "clicks": false,
        "scroll": false,
        "forms": {
            "submit": false,
            "inputs": false,
            "toggles": false
        }
    }
};
