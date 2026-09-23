<?php

/**
 * Playground
 */

declare(strict_types=1);
use Illuminate\Database\Eloquent\Model;
use Playground\Auth\Policies\Policy;
use Playground\Crm\Models\Client;
use Playground\Crm\Models\Contact;
use Playground\Crm\Models\Location;
use Playground\Crm\Models\Organization;
use Playground\Crm\Models\People;
use Playground\Crm\Resource\Policies\ClientPolicy;
use Playground\Crm\Resource\Policies\ContactPolicy;
use Playground\Crm\Resource\Policies\LocationPolicy;
use Playground\Crm\Resource\Policies\OrganizationPolicy;
use Playground\Crm\Resource\Policies\PeoplePolicy;

/**
 * Playground: CRM Resource Configuration and Environment Variables
 *
 * @return array{
 *       about: bool,
 *       layout: string,
 *       load: array{
 *           policies: bool,
 *           routes: bool,
 *           translations: bool,
 *           views: bool
 *       },
 *       matrix: array{
 *           enabled: bool,
 *       },
 *       middleware: array{
 *           default: string|string[],
 *           auth: string|string[],
 *           guest: string|string[]
 *       },
 *       policies: array<
 *           class-string<Model>,
 *           class-string<Policy>
 *       >,
 *       routes: array{
 *           crm: bool,
 *           clients: bool,
 *           contacts: bool,
 *           locations: bool,
 *           organizations: bool,
 *           peoples: bool,
 *       },
 *       blade: string,
 *       abilities: array<string, string[]>,
 *       sitemap: array{
 *            enable: bool,
 *            guest: bool,
 *            user: bool,
 *            view: string
 *       }
 *   }
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
    | Matrix
    |--------------------------------------------------------------------------
    |
    |
    */

    'matrix' => [
        'enabled' => (bool) env('PLAYGROUND_CRM_RESOURCE_MATRIX_ENABLED', false),
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
        Client::class => ClientPolicy::class,
        Contact::class => ContactPolicy::class,
        Location::class => LocationPolicy::class,
        Organization::class => OrganizationPolicy::class,
        People::class => PeoplePolicy::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    'routes' => [
        'crm' => (bool) env('PLAYGROUND_CRM_RESOURCE_ROUTES_CRM', true),
        'clients' => (bool) env('PLAYGROUND_CRM_RESOURCE_ROUTES_CLIENTS', true),
        'contacts' => (bool) env('PLAYGROUND_CRM_RESOURCE_ROUTES_CONTACTS', true),
        'locations' => (bool) env('PLAYGROUND_CRM_RESOURCE_ROUTES_LOCATIONS', true),
        'organizations' => (bool) env('PLAYGROUND_CRM_RESOURCE_ROUTES_ORGANIZATIONS', true),
        'peoples' => (bool) env('PLAYGROUND_CRM_RESOURCE_ROUTES_PEOPLES', true),
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
