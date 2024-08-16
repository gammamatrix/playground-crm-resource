<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Crm\Resource\Policies;

use Playground\Auth\Policies\ModelPolicy;

/**
 * \Playground\Crm\Resource\Policies\OrganizationPolicy
 */
class OrganizationPolicy extends ModelPolicy
{
    protected string $package = 'playground-crm-resource';

    /**
     * @var array<int, string> The roles allowed to view the MVC.
     */
    protected $rolesToView = [
        'user',
        'staff',
        'publisher',
        'manager',
        'admin',
        'root',
    ];

    /**
     * @var array<int, string> The roles allowed for actions in the MVC.
     */
    protected $rolesForAction = [
        'publisher',
        'manager',
        'admin',
        'root',
    ];
}
