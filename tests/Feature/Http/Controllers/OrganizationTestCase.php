<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Crm\Resource\Http\Controllers;

use Playground\Crm\Models\Organization;

/**
 * \Tests\Feature\Playground\Crm\Resource\Http\Controllers\OrganizationTestCase
 */
class OrganizationTestCase extends PlaygroundCase
{
    public string $fqdn = Organization::class;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_camel' => 'organization',
        'model_camels' => 'organizations',
        'model_kebab' => 'organization',
        'model_kebabs' => 'organizations',
        'model_lower' => 'organization',
        'model_lowers' => 'organizations',
        'model_label' => 'Organization',
        'model_label_plural' => 'Organizations',
        'model_labels' => 'Organizations',
        'model_route' => 'playground.crm.resource.organizations',
        'model_slug' => 'organization',
        'model_slugs' => 'organizations',
        'model_slug_plural' => 'organizations',
        'model_snake' => 'organization',
        'model_snakes' => 'organizations',
        'model_studly' => 'Organization',
        'model_studlies' => 'Organizations',
        'model_variable' => 'organization',
        'model_variables' => 'organizations',
        'model_variable_plural' => 'organizations',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource:organization',
        'table' => 'crm_organizations',
        'view' => 'playground.crm.resource::organization',
    ];

    /**
     * @var array<int, string>
     */
    protected $structure_model = [
        'id',
        'organization_type',
        'created_by_id',
        'modified_by_id',
        'owned_by_id',
        'parent_id',
        'matrix_id',
        'client_id',
        'contact_id',
        'location_id',
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
