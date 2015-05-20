<?php

namespace OpenStack\Identity\v2;

use OpenStack\Common\Api\ApiInterface;

/**
 * Represents the OpenStack Identity v2 API.
 *
 * @internal
 * @package OpenStack\Identity\v2
 */
class Api implements ApiInterface
{
    public function postToken()
    {
        return [
            'method' => 'POST',
            'path'   => 'tokens',
            'params' => [
                'username' => [
                    'type' => 'string',
                    'required' => true,
                    'path' => 'auth.passwordCredentials'
                ],
                'password' => [
                    'type' => 'string',
                    'required' => true,
                    'path' => 'auth.passwordCredentials'
                ],
                'tenantId' => [
                    'type' => 'string',
                    'path' => 'auth',
                ],
                'tenantName' => [
                    'type' => 'string',
                    'path' => 'auth',
                ]
            ],
        ];
    }

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
} 
