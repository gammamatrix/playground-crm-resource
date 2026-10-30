<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Crm\Resource\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Playground\Crm\Models\Tagged;

/**
 * \Tests\Feature\Playground\Crm\Resource\Http\Controllers\TaggedTestCase
 */
class TaggedTestCase extends TestCase
{
    /**
     * @var class-string<Model>
     */
    public string $fqdn = Tagged::class;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => 'tag_id',
        'model_camel' => 'tagged',
        'model_camels' => 'tagged',
        'model_kebab' => 'tagged',
        'model_kebabs' => 'tagged',
        'model_lower' => 'tagged',
        'model_lowers' => 'tagged',
        'model_label' => 'Tagged',
        'model_label_plural' => 'Tagged',
        'model_labels' => 'Tagged',
        'model_route' => 'playground.crm.resource.tagged',
        'model_route_param' => 'tagged',
        'model_slug' => 'tagged',
        'model_slugs' => 'tagged',
        'model_slug_plural' => 'tagged',
        'model_snake' => 'tagged',
        'model_snakes' => 'tagged',
        'model_studly' => 'Tagged',
        'model_studlies' => 'Tagged',
        'model_variable' => 'tagged',
        'model_variables' => 'tagged',
        'model_variable_plural' => 'tagged',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMs',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'module_slugs' => 'crms',
        'privilege' => 'playground-crm-resource:tagged',
        'table' => 'crm_tagged',
        'view' => 'playground.crm.resource::tagged',
    ];

    /**
     * @var array<int, string>
     */
    protected $structure_model = [
        'id',
        'created_by_id',
        'tag_id',
        'client_id',
        'contact_id',
        'location_id',
        'organization_id',
        'created_at',
    ];
}
