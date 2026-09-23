<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Tests\Feature\Playground\Crm\Resource\Http\Controllers;

use Playground\Test\Feature\Http\Controllers\Resource;

/**
 * \Tests\Feature\Playground\Crm\Resource\Http\Controllers\PlaygroundCase
 */
class PlaygroundCase extends TestCase
{
    use Resource\Playground\CreateJsonTrait;
    use Resource\Playground\CreateTrait;
    use Resource\Playground\DestroyJsonTrait;
    use Resource\Playground\DestroyTrait;
    use Resource\Playground\EditJsonTrait;
    use Resource\Playground\EditTrait;
    use Resource\Playground\IndexJsonTrait;
    use Resource\Playground\IndexTrait;
    use Resource\Playground\LockJsonTrait;
    use Resource\Playground\LockTrait;
    use Resource\Playground\RestoreJsonTrait;
    use Resource\Playground\RestoreTrait;
    use Resource\Playground\ShowJsonTrait;
    use Resource\Playground\ShowTrait;
    use Resource\Playground\StoreJsonTrait;
    use Resource\Playground\StoreTrait;
    use Resource\Playground\UnlockJsonTrait;
    use Resource\Playground\UnlockTrait;
    use Resource\Playground\UpdateJsonTrait;
    use Resource\Playground\UpdateTrait;

    protected bool $setUpUserForPlayground = true;
}
