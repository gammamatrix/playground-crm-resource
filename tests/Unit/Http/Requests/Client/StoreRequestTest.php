<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Crm\Resource\Http\Requests\Client;

use Playground\Crm\Resource\Http\Requests\Client\StoreRequest;
use Tests\Unit\Playground\Crm\Resource\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Http\Requests\Client\StoreRequestTest
 */
class StoreRequestTest extends RequestTestCase
{
    protected string $requestClass = StoreRequest::class;
}
