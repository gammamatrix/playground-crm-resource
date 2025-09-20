<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Crm\Resource\Http\Controllers;

use Illuminate\View\View;

/**
 * \Playground\Crm\Resource\Http\Controllers\IndexController
 */
class IndexController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'module_label' => 'CRM',
        'module_label_plural' => 'CRMS',
        'module_route' => 'playground.crm.resource',
        'module_slug' => 'crm',
        'privilege' => 'playground-crm-resource',
        'view' => 'playground-crm-resource',
    ];

    /**
     * Show the index.
     */
    public function index(): View
    {
        $packageInfo = $this->packageInfo();

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::index', $packageInfo->view());

        return view($view, [
            'packageInfo' => $packageInfo,
        ]);
    }
}
