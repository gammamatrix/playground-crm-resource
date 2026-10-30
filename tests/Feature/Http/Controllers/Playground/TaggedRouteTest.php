<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Crm\Resource\Http\Controllers\Playground;

use Playground\Crm\Models\Tagged;
use Playground\Models\User;
use Tests\Feature\Playground\Crm\Resource\Http\Controllers\TaggedTestCase;

/**
 * \Tests\Feature\Playground\Crm\Resource\Http\Controllers\Playground\TaggedRouteTest
 */
class TaggedRouteTest extends TaggedTestCase
{
    protected bool $load_migrations_playground = true;

    protected bool $setUpUserForPlayground = true;

    public function test_destroy_as_admin_and_succeed(): void
    {
        $packageInfo = $this->getPackageInfo();

        $user = User::factory()->admin()->create();

        $model = Tagged::factory()->create();

        $this->assertDatabaseHas($packageInfo['table'], [
            'id' => $model->id,
        ]);

        $url = route(sprintf(
            '%1$s.destroy',
            $packageInfo['model_route']
        ), [
            $packageInfo['model_route_param'] => $model->id,
        ]);

        $response = $this->actingAs($user)->delete($url);
        $this->assertDatabaseMissing($packageInfo['table'], [
            'id' => $model->id,
        ]);

        $response->assertRedirect(route('playground.crm.resource'));
    }
}
