import buble from 'rollup-plugin-buble'
import commonjs from 'rollup-plugin-commonjs'
import resolve from 'rollup-plugin-node-resolve'
import uglify from 'rollup-plugin-uglify'
import replace from 'rollup-plugin-replace'
import includePaths from 'rollup-plugin-includepaths'

export default {
    entry: 'resources/assets/js/app.js',
    dest: 'httpdocs/app/themes/site_theme/assets/js/app.js',
    format: 'iife',
    useStrict: true,
    external: ['jquery'],
    globals: {
        jquery: '$'
    },
    plugins: [
        includePaths({
            include: {},
            paths: ['resources/assets/js'],
            external: [],
            extensions: ['.js', '.json']
        }),
        resolve({
            jsnext: true, // Default: false
            main: true, // Default: true
            browser: true,
            extensions: ['.js', '.json']
        }),
        commonjs({
            include: ['node_modules/**', 'resources/**'],
            extensions: ['.js', '.json'],
            // if false then skip sourceMap generation for CommonJS modules
            sourceMap: true, // Default: true
        }),
        buble(),
        replace({
            exclude: 'node_modules/**',
            "process.env.NODE_ENV": JSON.stringify(process.env.NODE_ENV || 'development'),
        }),
        (process.env.NODE_ENV === 'production' && uglify())
    ],
    sourceMap: (process.env.NODE_ENV !== 'production') ? true : false
}