<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Resource\Policies\ContactPolicy;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Crm\Resource\Policies\ContactPolicy;
use Tests\Unit\Playground\Crm\Resource\TestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Policies\ContactPolicy\PolicyTest
 */
#[CoversClass(ContactPolicy::class)]
class PolicyTest extends TestCase
{
    public function test_policy_instance(): void
    {
        $instance = new ContactPolicy;

        $this->assertInstanceOf(ContactPolicy::class, $instance);
    }
}
