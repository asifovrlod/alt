<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default search index
    |--------------------------------------------------------------------------
    |
    | This option controls the search index that gets queried when performing
    | search functions without explicitly selecting another index.
    |
    */

    'default' => env('STATAMIC_DEFAULT_SEARCH_INDEX', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Search Indexes
    |--------------------------------------------------------------------------
    |
    | Here you can define all of the available search indexes.
    |
    */

    'indexes' => [

        'default' => [
            'driver' => 'local',
            'searchables' => 'all',
            'fields' => ['title'],
        ],

        'jobs' => [
            'driver' => 'algolia',
            'searchables' => 'collection:jobs',
            'fields' => ['title', 'job_details', 'location', 'salary_range'],
            'settings' => [
                'searchableAttributes' => ['title', 'job_details', 'location'],
                'attributesToSnippet' => ['job_details:30'],
            ],
        ],

        'companies' => [
            'driver' => 'algolia',
            'searchables' => 'collection:companies',
            'fields' => ['title', 'company', 'location'],
            'settings' => [
                'searchableAttributes' => ['title', 'company', 'location'],
                'attributesToSnippet' => ['company:30'],
            ],
        ],

        'site' => [
            'driver' => 'algolia',
            'searchables' => ['collection:jobs', 'collection:companies'],
            'fields' => ['title', 'job_details', 'location', 'salary_range', 'company'],
            'settings' => [
                'searchableAttributes' => ['title', 'job_details', 'location', 'company'],
                'attributesToSnippet' => ['job_details:30'],
            ],
        ],

        // 'blog' => [
        //     'driver' => 'local',
        //     'searchables' => 'collection:blog',
        // ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Driver Defaults
    |--------------------------------------------------------------------------
    |
    | Here you can specify default configuration to be applied to all indexes
    | that use the corresponding driver. For instance, if you have two
    | indexes that use the "local" driver, both of them can have the
    | same base configuration. You may override for each index.
    |
    */

    'drivers' => [

        'local' => [
            'path' => storage_path('statamic/search'),
        ],

        'algolia' => [
            'credentials' => [
                'id' => env('ALGOLIA_APP_ID', ''),
                'secret' => env('ALGOLIA_SECRET', ''),
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Search Defaults
    |--------------------------------------------------------------------------
    |
    | Here you can specify default configuration to be applied to all indexes
    | regardless of the driver. You can override these per driver or per index.
    |
    */

    'defaults' => [
        'fields' => ['title'],
    ],

];
