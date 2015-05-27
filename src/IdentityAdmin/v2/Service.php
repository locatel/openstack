<?php

namespace OpenStack\IdentityAdmin\v2;

use OpenStack\Common\Service\AbstractService;

/**
 * Represents the OpenStack IdentityAdmin v2 service.
 *
 * @property \OpenStack\IdentityAdmin\v2\Api $api
 */
class Service extends AbstractService
{
    /**
     * List tenants.
     *
     * @param array    $options {@see \OpenStack\Tenant\v2\Api::getTenants}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listTenants(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getTenants(), $options);
        return $this->model('Tenant')->enumerate($operation, $mapFn);
                                                                   }
    /**
     * Retrieve a tenant object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Tenant::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Tenant} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Tenant\v2\Models\Tenant
     */
    public function getTenant(array $options = [])
    {
        $tenant = $this->model('Tenant');
        $tenant->populateFromArray($options);
        return $tenant;
    }

    /**
     * Create a new tenant.
     *
     * @param array $options {@see \OpenStack\IdentityAdmin\v2\Api::postTenant}
     *
     * @return \OpenStack\IdentityAdmin\v2\Models\Tenant
     */
    public function createTenant(array $options)
    {
        //return $this->model('Tenant')->create(array_merge($options, ['urlType' => 'adminURL']));
        return $this->model('Tenant')->create($options);
    }

    /**
     * List users.
     *
     * @param array    $options {@see \OpenStack\User\v2\Api::getUsers}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listUsers(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getUsers(), $options);
        return $this->model('User')->enumerate($operation, $mapFn);
                                                                   }
    /**
     * Retrieve a user object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see User::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see User} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\User\v2\Models\User
     */
    public function getUser(array $options = [])
    {
        $user = $this->model('User');
        $user->populateFromArray($options);
        return $user;
    }

    /**
     * Create a new user.
     *
     * @param array $options {@see \OpenStack\IdentityAdmin\v2\Api::postUser}
     *
     * @return \OpenStack\IdentityAdmin\v2\Models\User
     */
    public function createUser(array $options)
    {
        //return $this->model('User')->create(array_merge($options, ['urlType' => 'adminURL']));
        return $this->model('User')->create($options);
    }

    /**
     * Add roles to user on tenant
     *
     */
    public function associateUser(array $options)
    {
        return $this->model('User')->associate($options);
    }

}
