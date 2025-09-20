<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Crm\Resource\Http\Requests\People;

use Playground\Crm\Resource\Http\Requests\People\UpdateRequest;
use Tests\Unit\Playground\Crm\Resource\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Http\Requests\People\UpdateRequestTest
 */
class UpdateRequestTest extends RequestTestCase
{
    protected string $requestClass = UpdateRequest::class;
}
