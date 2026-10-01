<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Crm\Resource\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Tests\Feature\Playground\Crm\Resource\TestCase as BaseTestCase;

/**
 * \Tests\Feature\Playground\Crm\Resource\Http\Controllers\TestCase
 */
class TestCase extends BaseTestCase
{
    /**
     * @var class-string<Model>
     */
    public string $fqdn = Model::class;

    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'model_attribute' => '',
        'model_camel' => '',
        'model_camels' => '',
        'model_kebab' => '',
        'model_kebabs' => '',
        'model_lower' => '',
        'model_lowers' => '',
        'model_label' => '',
        'model_label_plural' => '',
        'model_labels' => '',
        'model_route' => '',
        'model_route_param' => '',
        'model_slug' => '',
        'model_slugs' => '',
        'model_slug_plural' => '',
        'model_snake' => '',
        'model_snakes' => '',
        'model_studly' => '',
        'model_studlies' => '',
        'model_variable' => '',
        'model_variables' => '',
        'model_variable_plural' => '',
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMs',
        'module_labels' => 'CRMs',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'module_slugs' => 'crms',
        'privilege' => 'playground-crm-resource:',
        'table' => '',
        'view' => 'playground-crm-resource::',
    ];

    /**
     * @var array<int, string>
     */
    protected $structure_model = [
        'id',
    ];

    /**
     * @return class-string<Model>
     */
    public function getGetFqdn(): string
    {
        return $this->fqdn;
    }

    /**
     * @return array<string, string>
     */
    public function getPackageInfo(): array
    {
        return $this->packageInfo;
    }

    /**
     * @return array<string, mixed>
     */
    public function getStructureCreate(): array
    {
        return [
            'data' => array_diff($this->structure_model, [
                'id',
            ]),
            'meta' => [
                'timestamp',
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function getStructureData(): array
    {
        return [
            'data' => $this->structure_model,
            'meta' => [
                'timestamp',
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function getStructureEdit(): array
    {
        return [
            'data' => $this->structure_model,
            'meta' => [
                'timestamp',
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function getStructureIndex(): array
    {
        return [
            'data' => [
                '*' => $this->structure_model,
            ],
            'meta' => [
                'session_user_id',
                'sortable',
                'timestamp',
                // 'pagination' => [
                //     'count',
                //     'current_page',
                //     'links' => [
                //         'first',
                //         'last',
                //         'next',
                //         'path',
                //         'previous',
                //     ],
                //     'from',
                //     'last_page',
                //     'next_page',
                //     'per_page',
                //     'prev_page',
                //     'to',
                //     'total',
                //     'total_pages',
                // ],
            ],

        ];
    }
}
