const mix = require('laravel-mix');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Enable production optimizations
if (mix.inProduction()) {
    mix.version();
    mix.options({
        terser: {
            terserOptions: {
                compress: {
                    drop_console: true,
                    drop_debugger: true,
                },
            },
        },
    });
}

// Main application bundle
mix.js('resources/js/app.js', 'public/js')
   .vue({ version: 3 })
   .sass('resources/sass/app.scss', 'public/css')
   .options({
       processCssUrls: false,
       postCss: [
           require('autoprefixer'),
           require('cssnano')({
               preset: 'default',
           }),
       ],
   });

// Extract vendor libraries for better caching
mix.extract(['vue', 'axios', 'lodash', 'bootstrap', 'jquery', '@popperjs/core']);

// Enable source maps in development
if (!mix.inProduction()) {
    mix.sourceMaps();
}

// Bundle analyzer (run with npm run analyze)
if (process.argv.includes('--analyze')) {
    mix.webpackConfig({
        plugins: [
            new (require('webpack-bundle-analyzer')).BundleAnalyzerPlugin({
                openAnalyzer: false,
                analyzerMode: 'static',
                reportFilename: 'bundle-report.html',
            }),
        ],
    });
}

// Performance optimizations
mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    optimization: {
        splitChunks: {
            chunks: 'all',
            cacheGroups: {
                vendor: {
                    test: /[\\/]node_modules[\\/]/,
                    name: 'vendors',
                    chunks: 'all',
                },
            },
        },
    },
});

// Disable mix-manifest notifications in production
mix.disableNotifications();
