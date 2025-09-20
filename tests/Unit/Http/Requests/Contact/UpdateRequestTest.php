<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Unit\Playground\Crm\Resource\Http\Requests\Contact;

use Playground\Crm\Resource\Http\Requests\Contact\UpdateRequest;
use Tests\Unit\Playground\Crm\Resource\Http\Requests\RequestTestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Http\Requests\Contact\UpdateRequestTest
 */
class UpdateRequestTest extends RequestTestCase
{
    protected string $requestClass = UpdateRequest::class;
}
