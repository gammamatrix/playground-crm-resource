<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Resource\Policies\PeoplePolicy;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Crm\Resource\Policies\PeoplePolicy;
use Tests\Unit\Playground\Crm\Resource\TestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Policies\PeoplePolicy\PolicyTest
 */
#[CoversClass(PeoplePolicy::class)]
class PolicyTest extends TestCase
{
    public function test_policy_instance(): void
    {
        $instance = new PeoplePolicy;

        $this->assertInstanceOf(PeoplePolicy::class, $instance);
    }
}
