<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Crm\Resource\Http\Controllers;

use Playground\Crm\Models\People;

/**
 * \Tests\Feature\Playground\Crm\Resource\Http\Controllers\PeopleTestCase
 */
class PeopleTestCase extends PlaygroundCase
{
    public string $fqdn = People::class;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_camel' => 'people',
        'model_camels' => 'peoples',
        'model_kebab' => 'people',
        'model_kebabs' => 'peoples',
        'model_lower' => 'people',
        'model_lowers' => 'people',
        'model_label' => 'People',
        'model_label_plural' => 'People',
        'model_labels' => 'People',
        'model_route' => 'playground.crm.resource.peoples',
        'model_slug' => 'people',
        'model_slugs' => 'peoples',
        'model_slug_plural' => 'peoples',
        'model_snake' => 'people',
        'model_snakes' => 'peoples',
        'model_studly' => 'People',
        'model_studlies' => 'Peoples',
        'model_variable' => 'people',
        'model_variables' => 'peoples',
        'model_variable_plural' => 'peoples',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource:people',
        'table' => 'crm_peoples',
        'view' => 'playground.crm.resource::people',
    ];

    /**
     * @var array<int, string>
     */
    protected $structure_model = [
        'id',
        'people_type',
        'created_by_id',
        'modified_by_id',
        'owned_by_id',
        'parent_id',
        'matrix_id',
        'client_id',
        'contact_id',
        'location_id',
        'organization_id',
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
