<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Crm\Resource\Http\Requests\Organization;

use Playground\Crm\Resource\Http\Requests\FormRequest;

/**
 * \Playground\Crm\Resource\Http\Requests\Organization\UnlockRequest
 */
class UnlockRequest extends FormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        '_return_url' => ['nullable', 'url'],
    ];
}
