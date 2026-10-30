<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Crm\Resource\Http\Requests\Tagged;

use Playground\Http\Requests\StoreRequest as BaseStoreRequest;

/**
 * \Playground\Crm\Resource\Http\Requests\Tagged\StoreRequest
 */
class StoreRequest extends BaseStoreRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        'tag_id' => ['uuid', 'required'],
        'client_id' => ['nullable', 'uuid'],
        'contact_id' => ['nullable', 'uuid'],
        'location_id' => ['nullable', 'uuid'],
        'organization_id' => ['nullable', 'uuid'],
        '_return_url' => ['nullable', 'url'],
    ];

    protected string $slug_table = 'crm_tagged';

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $input = [];

        $this->filterContentFields($input);
        $this->filterCommonFields($input);
        $this->filterStatus($input);
        $this->filterSystemFields($input);

        if (! empty($input)) {
            $this->merge($input);
        }
    }
}
