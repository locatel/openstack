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
    private $idParam = [
        'type' => 'string',
        'required' => true,
        'location' => 'url',
        'description' => 'The unique ID of the remote resource.',
    ];

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

    public function deleteTenant()
    {
        return [
            'method' => 'DELETE',
            'path'   => 'tenants/{id}',
            'params' => ['id' => $this->idParam],
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
                'email' => [
                    'type' => 'string',
                    'required' => true,
                ],
				'password' => [
					'type' => 'string',
					'required' => false,
				],
            ]
        ];
    }

    public function deleteUser()
    {
        return [
            'method' => 'DELETE',
            'path'   => 'users/{id}',
            'params' => ['id' => $this->idParam],
        ];
    }

    public function associateUser()
    {
        return [
            'method' => 'PUT',
            'path'   => 'tenants/{tenant_id}/users/{user_id}/roles/OS-KSADM/{role_id}',
            'params' => [
                'tenant_id' => [
                    'type' => 'string',
                    'required' => true,
                ],
                'user_id' => [
                    'type' => 'string',
                    'required' => true,
                ],
                'role_id' => [
                    'type' => 'string',
                    'required' => true,
                ],
            ]
        ];
    }
} 
