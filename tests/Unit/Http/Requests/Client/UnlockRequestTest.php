<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Resource\Http\Requests\Client;

use Tests\Unit\Playground\Crm\Resource\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Http\Requests\Client\UnlockRequestTest
 */
class UnlockRequestTest extends RequestTestCase
{
    protected string $requestClass = \Playground\Crm\Resource\Http\Requests\Client\UnlockRequest::class;
}
