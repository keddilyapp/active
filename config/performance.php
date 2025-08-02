<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Performance Optimization Settings
    |--------------------------------------------------------------------------
    |
    | This file contains various performance optimization settings for your
    | Laravel application. These settings help improve load times, reduce
    | memory usage, and enhance overall application performance.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Asset Optimization
    |--------------------------------------------------------------------------
    */
    'assets' => [
        'minify_css' => env('MINIFY_CSS', true),
        'minify_js' => env('MINIFY_JS', true),
        'combine_assets' => env('COMBINE_ASSETS', true),
        'cdn_url' => env('CDN_URL', null),
        'asset_version' => env('ASSET_VERSION', '1.0.0'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Optimization
    |--------------------------------------------------------------------------
    */
    'images' => [
        'lazy_loading' => env('LAZY_LOADING', true),
        'webp_conversion' => env('WEBP_CONVERSION', true),
        'image_quality' => env('IMAGE_QUALITY', 85),
        'thumbnail_cache' => env('THUMBNAIL_CACHE', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Caching Strategy
    |--------------------------------------------------------------------------
    */
    'caching' => [
        'view_cache' => env('VIEW_CACHE', true),
        'route_cache' => env('ROUTE_CACHE', true),
        'config_cache' => env('CONFIG_CACHE', true),
        'query_cache' => env('QUERY_CACHE', true),
        'cache_ttl' => env('CACHE_TTL', 3600), // 1 hour
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Optimization
    |--------------------------------------------------------------------------
    */
    'database' => [
        'query_log' => env('DB_QUERY_LOG', false),
        'connection_pooling' => env('DB_CONNECTION_POOLING', true),
        'persistent_connections' => env('DB_PERSISTENT', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | HTTP Optimization
    |--------------------------------------------------------------------------
    */
    'http' => [
        'gzip_compression' => env('GZIP_COMPRESSION', true),
        'browser_caching' => env('BROWSER_CACHING', true),
        'etag_enabled' => env('ETAG_ENABLED', true),
        'keep_alive' => env('KEEP_ALIVE', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Code Optimization
    |--------------------------------------------------------------------------
    */
    'code' => [
        'opcache_enabled' => env('OPCACHE_ENABLED', true),
        'autoloader_optimization' => env('AUTOLOADER_OPTIMIZATION', true),
        'eager_loading' => env('EAGER_LOADING', true),
    ],

];