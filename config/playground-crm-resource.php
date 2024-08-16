<?php
/**
 * Playground
 */

declare(strict_types=1);

/**
 * Playground: CRM Resource Configuration and Environment Variables
 */
return [

    /*
    |--------------------------------------------------------------------------
    | About Information
    |--------------------------------------------------------------------------
    |
    | By default, information will be displayed about this package when using:
    |
    | `artisan about`
    |
    */

    'about' => (bool) env('PLAYGROUND_CRM_RESOURCE_ABOUT', true),

    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    |
    | By default, translations and views are loaded.
    |
    */

    'load' => [
        'policies' => (bool) env('PLAYGROUND_CRM_RESOURCE_LOAD_POLICIES', true),
        'routes' => (bool) env('PLAYGROUND_CRM_RESOURCE_LOAD_ROUTES', true),
        'translations' => (bool) env('PLAYGROUND_CRM_RESOURCE_LOAD_TRANSLATIONS', true),
        'views' => (bool) env('PLAYGROUND_CRM_RESOURCE_LOAD_VIEWS', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    |
    */

    'middleware' => [
        'default' => env('PLAYGROUND_CRM_RESOURCE_MIDDLEWARE_DEFAULT', ['web']),
        'auth' => env('PLAYGROUND_CRM_RESOURCE_MIDDLEWARE_AUTH', ['web', 'auth']),
        'guest' => env('PLAYGROUND_CRM_RESOURCE_MIDDLEWARE_GUEST', ['web']),
    ],

    /*
    |--------------------------------------------------------------------------
    | Policies
    |--------------------------------------------------------------------------
    |
    |
    */

    'policies' => [
        Playground\Crm\Models\Client::class => Playground\Crm\Resource\Policies\ClientPolicy::class,
        Playground\Crm\Models\Contact::class => Playground\Crm\Resource\Policies\ContactPolicy::class,
        Playground\Crm\Models\Location::class => Playground\Crm\Resource\Policies\LocationPolicy::class,
        Playground\Crm\Models\Organization::class => Playground\Crm\Resource\Policies\OrganizationPolicy::class,
        Playground\Crm\Models\People::class => Playground\Crm\Resource\Policies\PeoplePolicy::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    'routes' => [
        'crm' => (bool) env('PLAYGROUND_CRM_RESOURCE_CRM', true),
        'clients' => (bool) env('PLAYGROUND_CRM_RESOURCE_CLIENTS', true),
        'contacts' => (bool) env('PLAYGROUND_CRM_RESOURCE_CONTACTS', true),
        'locations' => (bool) env('PLAYGROUND_CRM_RESOURCE_LOCATIONS', true),
        'organizations' => (bool) env('PLAYGROUND_CRM_RESOURCE_ORGANIZATIONS', true),
        'people' => (bool) env('PLAYGROUND_CRM_RESOURCE_PEOPLE', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Sitemap
    |--------------------------------------------------------------------------
    |
    |
    */

    'sitemap' => [
        'enable' => (bool) env('PLAYGROUND_CRM_RESOURCE_SITEMAP_ENABLE', true),
        'guest' => (bool) env('PLAYGROUND_CRM_RESOURCE_SITEMAP_GUEST', true),
        'user' => (bool) env('PLAYGROUND_CRM_RESOURCE_SITEMAP_USER', true),
        'view' => env('PLAYGROUND_CRM_RESOURCE_SITEMAP_VIEW', 'playground-crm-resource::sitemap'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    |
    */

    'blade' => env('PLAYGROUND_CRM_RESOURCE_BLADE', 'playground-crm-resource::'),

    /*
    |--------------------------------------------------------------------------
    | Abilities
    |--------------------------------------------------------------------------
    |
    |
    */

    'abilities' => [
        'admin' => [
            'playground-crm-resource:*',
        ],
        'manager' => [
            'playground-crm-resource:client:*',
            'playground-crm-resource:contact:*',
            'playground-crm-resource:location:*',
            'playground-crm-resource:organization:*',
            'playground-crm-resource:people:*',
        ],
        'user' => [
            'playground-crm-resource:client:view',
            'playground-crm-resource:client:viewAny',
            'playground-crm-resource:contact:view',
            'playground-crm-resource:contact:viewAny',
            'playground-crm-resource:location:view',
            'playground-crm-resource:location:viewAny',
            'playground-crm-resource:organization:view',
            'playground-crm-resource:organization:viewAny',
            'playground-crm-resource:people:view',
            'playground-crm-resource:people:viewAny',
        ],
    ],
];
