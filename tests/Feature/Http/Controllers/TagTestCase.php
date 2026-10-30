<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Crm\Resource\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Playground\Crm\Models\Tag;

/**
 * \Tests\Feature\Playground\Crm\Resource\Http\Controllers\TagTestCase
 */
class TagTestCase extends PlaygroundCase
{
    /**
     * @var class-string<Model>
     */
    public string $fqdn = Tag::class;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'title',
        'model_camel' => 'tag',
        'model_camels' => 'tags',
        'model_kebab' => 'tag',
        'model_kebabs' => 'tags',
        'model_lower' => 'tag',
        'model_lowers' => 'tags',
        'model_label' => 'Tag',
        'model_label_plural' => 'Tags',
        'model_labels' => 'Tags',
        'model_route' => 'playground.crm.resource.tags',
        'model_route_param' => 'tag',
        'model_slug' => 'tag',
        'model_slugs' => 'tags',
        'model_slug_plural' => 'tags',
        'model_snake' => 'tag',
        'model_snakes' => 'tags',
        'model_studly' => 'Tag',
        'model_studlies' => 'Tags',
        'model_variable' => 'tag',
        'model_variables' => 'tags',
        'model_variable_plural' => 'tags',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMs',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'module_slugs' => 'crms',
        'privilege' => 'playground-crm-resource:tag',
        'table' => 'crm_tags',
        'view' => 'playground.crm.resource::tag',
    ];

    /**
     * @var array<int, string>
     */
    protected $structure_model = [
        'id',
        'tag_type',
        'created_by_id',
        'modified_by_id',
        'owned_by_id',
        'parent_id',
        'matrix_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'canceled_at',
        'closed_at',
        'embargo_at',
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
        'icon',
        'image',
        'avatar',
        'ui',
        'assets',
        'meta',
        'notes',
        'options',
        'sources',
    ];
}
