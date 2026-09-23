<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Crm\Resource\Http\Controllers;

use Playground\Crm\Models\Location;

/**
 * \Tests\Feature\Playground\Crm\Resource\Http\Controllers\LocationTestCase
 */
class LocationTestCase extends PlaygroundCase
{
    public string $fqdn = Location::class;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_camel' => 'location',
        'model_camels' => 'locations',
        'model_kebab' => 'location',
        'model_kebabs' => 'locations',
        'model_lower' => 'location',
        'model_lowers' => 'locations',
        'model_label' => 'Location',
        'model_label_plural' => 'Locations',
        'model_labels' => 'Locations',
        'model_route' => 'playground.crm.resource.locations',
        'model_slug' => 'location',
        'model_slugs' => 'locations',
        'model_slug_plural' => 'locations',
        'model_snake' => 'location',
        'model_snakes' => 'locations',
        'model_studly' => 'Location',
        'model_studlies' => 'Locations',
        'model_variable' => 'location',
        'model_variables' => 'locations',
        'model_variable_plural' => 'locations',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource:location',
        'table' => 'crm_locations',
        'view' => 'playground.crm.resource::location',
    ];

    /**
     * @var array<int, string>
     */
    protected $structure_model = [
        'id',
        'location_type',
        'created_by_id',
        'modified_by_id',
        'owned_by_id',
        'parent_id',
        'matrix_id',
        'client_id',
        'contact_id',
        'organization_id',
        'people_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'canceled_at',
        'closed_at',
        'embargo_at',
        'fixed_at',
        'planned_end_at',
        'planned_start_at',
        'postponed_at',
        'published_at',
        'released_at',
        'resolved_at',
        'resumed_at',
        'suspended_at',
        'timer_end_at',
        'timer_start_at',
        'gids',
        'po',
        'pg',
        'pw',
        'only_admin',
        'only_user',
        'only_guest',
        'allow_public',
        'status',
        'rank',
        'size',
        'matrix',
        'x',
        'y',
        'z',
        'r',
        'theta',
        'rho',
        'phi',
        'elevation',
        'latitude',
        'longitude',
        'active',
        'canceled',
        'closed',
        'completed',
        'cron',
        'duplicate',
        'featured',
        'fixed',
        'flagged',
        'internal',
        'locked',
        'pending',
        'planned',
        'prioritized',
        'problem',
        'published',
        'released',
        'resolved',
        'retired',
        'sms',
        'suspended',
        'unknown',
        'locale',
        'label',
        'title',
        'byline',
        'slug',
        'url',
        'description',
        'introduction',
        'content',
        'summary',
        'email',
        'phone',
        'icon',
        'image',
        'avatar',
        'ui',
        'address',
        'assets',
        'contact',
        'meta',
        'notes',
        'options',
        'sources',
    ];
}
