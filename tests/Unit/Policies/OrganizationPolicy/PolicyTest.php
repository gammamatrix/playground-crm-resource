<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Crm\Resource\Policies\OrganizationPolicy;

use PHPUnit\Framework\Attributes\CoversClass;
use Playground\Crm\Resource\Policies\OrganizationPolicy;
use Tests\Unit\Playground\Crm\Resource\TestCase;

/**
 * \Tests\Unit\Playground\Crm\Resource\Policies\OrganizationPolicy\PolicyTest
 */
#[CoversClass(OrganizationPolicy::class)]
class PolicyTest extends TestCase
{
    public function test_policy_instance(): void
    {
        $instance = new OrganizationPolicy;

        $this->assertInstanceOf(OrganizationPolicy::class, $instance);
    }
}
