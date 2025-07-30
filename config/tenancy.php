
<?php

return [
    'tenant_model' => \App\Models\Tenant::class,
    'id_generator' => \Stancl\Tenancy\UUIDGenerator::class,

    'domain_model' => \Stancl\Tenancy\Database\Models\Domain::class,

    'central_domains' => [
        'localhost',
        '127.0.0.1',
        env('APP_DOMAIN', 'localhost'),
    ],

    'bootstrappers' => [
        \Stancl\Tenancy\Bootstrappers\DatabaseTenancyBootstrapper::class,
        \Stancl\Tenancy\Bootstrappers\CacheTenancyBootstrapper::class,
        \Stancl\Tenancy\Bootstrappers\FilesystemTenancyBootstrapper::class,
        \Stancl\Tenancy\Bootstrappers\QueueTenancyBootstrapper::class,
    ],

    'database' => [
        'central_connection' => env('DB_CONNECTION', 'mysql'),
        'template_tenant_connection' => null,
        'prefix' => 'tenant',
        'suffix' => '',
        'managers' => [
            'mysql' => \Stancl\Tenancy\Database\DatabaseManager::class,
        ],
    ],

    'cache' => [
        'tag_base' => 'tenant',
    ],

    'filesystem' => [
        'suffix_base' => 'tenant',
        'disks' => [
            'local',
            'public',
        ],
    ],

    'redis' => [
        'prefix_base' => 'tenant',
    ],

    'features' => [
        // \Stancl\Tenancy\Features\UserImpersonation::class,
        \Stancl\Tenancy\Features\TelescopeTags::class,
        \Stancl\Tenancy\Features\UniversalRoutes::class,
        \Stancl\Tenancy\Features\TenantConfig::class,
    ],

    'migration_parameters' => [
        '--force' => true,
        '--path' => [database_path('migrations/tenant')],
        '--realpath' => true,
    ],

    'seeder_parameters' => [
        '--class' => 'DatabaseSeeder',
        '--force' => true,
    ],
];
