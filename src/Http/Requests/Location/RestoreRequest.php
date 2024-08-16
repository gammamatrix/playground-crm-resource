<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Crm\Resource\Http\Requests\Location;

use Playground\Crm\Resource\Http\Requests\FormRequest;

/**
 * \Playground\Crm\Resource\Http\Requests\Location\RestoreRequest
 */
class RestoreRequest extends FormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        '_return_url' => ['nullable', 'url'],
    ];
}
