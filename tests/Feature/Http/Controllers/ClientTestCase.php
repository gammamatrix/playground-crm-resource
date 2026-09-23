<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Crm\Resource\Http\Controllers;

use Playground\Crm\Models\Client;

/**
 * \Tests\Feature\Playground\Crm\Resource\Http\Controllers\ClientTestCase
 */
class ClientTestCase extends PlaygroundCase
{
    public string $fqdn = Client::class;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_camel' => 'client',
        'model_camels' => 'clients',
        'model_kebab' => 'client',
        'model_kebabs' => 'clients',
        'model_lower' => 'client',
        'model_lowers' => 'clients',
        'model_label' => 'Client',
        'model_label_plural' => 'Clients',
        'model_labels' => 'Clients',
        'model_route' => 'playground.crm.resource.clients',
        'model_slug' => 'client',
        'model_slugs' => 'clients',
        'model_slug_plural' => 'clients',
        'model_snake' => 'client',
        'model_snakes' => 'clients',
        'model_studly' => 'Client',
        'model_studlies' => 'Clients',
        'model_variable' => 'client',
        'model_variables' => 'clients',
        'model_variable_plural' => 'clients',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource:client',
        'table' => 'crm_clients',
        'view' => 'playground.crm.resource::client',
    ];

    /**
     * @var array<int, string>
     */
    protected $structure_model = [
        'id',
        'client_type',
        'created_by_id',
        'modified_by_id',
        'owned_by_id',
        'parent_id',
        'matrix_id',
        'contact_id',
        'location_id',
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
