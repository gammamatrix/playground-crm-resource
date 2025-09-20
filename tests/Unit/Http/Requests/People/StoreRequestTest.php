<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Crm\Resource\Http\Requests\People;

use Playground\Crm\Resource\Http\Requests\People\StoreRequest;
use Tests\Unit\Playground\Crm\Resource\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Http\Requests\People\StoreRequestTest
 */
class StoreRequestTest extends RequestTestCase
{
    protected string $requestClass = StoreRequest::class;
}
