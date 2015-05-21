<?php

namespace OpenStack\IdentityAdmin\v2;

use OpenStack\Common\Api\ApiInterface;

/**
 * Represents the OpenStack IdentityAdmin v2 API.
 *
 * @internal
 * @package OpenStack\IdentityAdmin\v2
 */
class Api implements ApiInterface
{
    public function getTenants()
    {
        return [
            'method' => 'GET',
            'path'   => 'tenants',
            'params' => [
                'domainId' => [
                    'type' => 'string',
                    'sentAs' => 'domain_id',
                    'location' => 'query'
                ],
                'enabled' => [
                    'type' => 'boolean',
                    'location' => 'query'
                ],
                'name' => [
                    'type' => 'string',
                    'location' => 'query'
                ]
            ]
        ];
    }

    public function getTenant()
    {
        return [
            'method' => 'GET',
            'path'   => 'tenants/{id}',
            'params' => [
                'id' => [
                    'type' => 'string',
                    'location' => 'url',
                    'required' => true,
                ]
            ]
        ];
    }

    public function postTenant()
    {
        return [
            'method' => 'POST',
            'path'   => 'tenants',
			'jsonKey' => 'tenant',
            'params' => [
                'name' => [
                    'type' => 'string',
                    'required' => true,
                ],
                'description' => [
                    'type' => 'string',
                    'required' => false,
                ],
            ]
        ];
    }

    public function getTenantUsers()
    {
        return [
            'method' => 'GET',
            'path'   => 'tenants/{id}/users',
            'params' => [
                'id' => [
                    'type' => 'string',
                    'location' => 'url',
                    'required' => true,
                ]
            ]
        ];
    }

    public function getUsers()
    {
        return [
            'method' => 'GET',
            'path'   => 'users',
            'params' => [
                'enabled' => [
                    'type' => 'boolean',
                    'location' => 'query'
                ],
                'name' => [
                    'type' => 'string',
                    'location' => 'query'
                ]
            ]
        ];
    }

    public function getUser()
    {
        return [
            'method' => 'GET',
            'path'   => 'users/{id}',
            'params' => [
                'id' => [
                    'type' => 'string',
                    'location' => 'url',
                    'required' => true,
                ]
            ]
        ];
    }

    public function postUser()
    {
        return [
            'method' => 'POST',
            'path'   => 'users',
			'jsonKey' => 'user',
            'params' => [
                'name' => [
                    'type' => 'string',
                    'required' => true,
                ],
            ]
        ];
    }
} 
