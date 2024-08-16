<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Resource\Http\Requests\Organization;

use Tests\Unit\Playground\Crm\Resource\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Http\Requests\Organization\ShowRequestTest
 */
class ShowRequestTest extends RequestTestCase
{
    protected string $requestClass = \Playground\Crm\Resource\Http\Requests\Organization\ShowRequest::class;
}
