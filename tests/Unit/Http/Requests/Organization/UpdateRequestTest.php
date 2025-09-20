<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Crm\Resource\Http\Requests\Organization;

use Playground\Crm\Resource\Http\Requests\Organization\UpdateRequest;
use Tests\Unit\Playground\Crm\Resource\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Http\Requests\Organization\UpdateRequestTest
 */
class UpdateRequestTest extends RequestTestCase
{
    protected string $requestClass = UpdateRequest::class;
}
