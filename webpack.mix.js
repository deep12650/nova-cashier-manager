let mix = require('laravel-mix')
const VueLoaderPlugin = require('vue-loader/dist/plugin').default

mix.js('resources/js/tool.js', 'dist/js')
    .vue() // <-- This is the Vue 3 loader
    .sass('resources/sass/tool.scss', 'dist/css')

module.exports = {
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            // Other rules...
        ]
    },
    plugins: [
        new VueLoaderPlugin()
        // Other plugins...
    ]
}
