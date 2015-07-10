<?php

namespace OpenStack\Network\v2;

use OpenStack\Common\Api\ApiInterface;

/**
 * A representation of the Network (Nova) v2 REST API.
 *
 * @internal
 * @package OpenStack\Network\v2
 */
class Api implements ApiInterface
{
    private $idParam = [
        'type' => 'string',
        'required' => true,
        'location' => 'url',
        'description' => 'The unique ID of the remote resource.',
    ];

    private $nameParam = [
        'type' => 'string',
        'location' => 'json',
        'description' => 'The name of the resource',
    ];

    private $keyParam = [
        'type' => 'string',
        'location' => 'url',
        'required' => true,
        'description' => 'The specific metadata key you are interacting with',
    ];

    private $limitParam = [
        'type'     => 'integer',
        'location' => 'query',
        'description' => <<<DESC
This will limit the total amount of elements returned in a list up to the number specified. For example, specifying a
limit of 10 will return 10 elements, regardless of the actual count.
DESC
    ];

    private $markerParam = [
        'type'     => 'string',
        'location' => 'query',
        'description' => <<<DESC
Specifying a marker will begin the list from the value specified. Elements will have a particular attribute that
identifies them, such as a name or ID. The marker value will search for an element whose identifying attribute matches
the marker value, and begin the list from there.
DESC
    ];

    public function postNetwork()
    {
        return [
            'method' => 'POST',
            'path'   => 'v2.0/networks',
            'jsonKey' => 'network',
            'params' => [
                'name' => $this->nameParam,
            ]
        ];
    }

    public function getNetworks()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/networks',
            'params' => [
                'limit'   => $this->limitParam,
                //'marker'  => $this->markerParam,
            ],
        ];
    }

    public function getNetworksDetail()
    {
        $op = $this->getAll();
        $op['path'] += '/detail';
        return $op;
    }

    public function getNetwork()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/networks/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function deleteNetwork()
    {
        return [
            'method' => 'DELETE',
            'path'   => 'v2.0/networks/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function getSubnets()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/subnets',
            'params' => [
                'limit'   => $this->limitParam,
                //'marker'  => $this->markerParam,
            ],
        ];
    }


    public function getSubnetsDetail()
    {
        $op = $this->getAll();
        $op['path'] += '/detail';
        return $op;
    }

    public function getSubnet()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/subnets/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function postSubnet()
    {
        return [
            'method' => 'POST',
            'path'   => 'v2.0/subnets',
            'jsonKey' => 'subnet',
            'params' => [
                'network_id' => [
					'type' => 'string',
					'required' => true,
				],
				'ip_version' => [
					'type' => 'integer',
					'required' => true,
				],
				'cidr' => [
					'type' => 'string',
					'required' => true,
				],

            ]
        ];
    }

    public function postRouter()
    {
        return [
            'method' => 'POST',
            'path'   => 'v2.0/routers',
            'jsonKey' => 'router',
            'params' => [
                'name' => $this->nameParam,
				'external_gateway_info' => [
					'type' => 'object',
					'properties' => [
						'network_id' => [
							'type' => 'string',
							'required' => true,
						],
					],
				],
            ]
        ];
    }

    public function getRouters()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/routers',
            'params' => [
                'limit'   => $this->limitParam,
                //'marker'  => $this->markerParam,
            ],
        ];
    }

    public function getRoutersDetail()
    {
        $op = $this->getAll();
        $op['path'] += '/detail';
        return $op;
    }

    public function getRouter()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/routers/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

	public function putAddRouterInterface()
	{
		return [
			'method' => 'PUT',
			'path'   => 'v2.0/routers/{id}/add_router_interface',
			'params' => [
				'id' => $this->idParam,
                'subnet_id' => [
					'type' => 'string',
					'required' => true,
				],
			],
		];
	}

    public function deleteRouter()
    {
        return [
            'method' => 'DELETE',
            'path'   => 'v2.0/routers/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function postPort()
    {
        return [
            'method' => 'POST',
            'path'   => 'v2.0/ports',
            'jsonKey' => 'router',
            'params' => [
                'network_id' => [
					'type' => 'string',
					'required' => true,
				],
            ]
        ];
    }

    public function getPorts()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/ports',
            'params' => [
                'limit'   => $this->limitParam,
                //'marker'  => $this->markerParam,
				'device_id' => [
					'type' => 'string',
					'location' => 'query',
					'description' => '',
				],
				/*
				'network_id ' => [
					'type' => 'string',
					'location' => 'query',
					'description' => '',
				],
				*/
            ],
        ];
    }

    public function getPortsDetail()
    {
        $op = $this->getAll();
        $op['path'] += '/detail';
        return $op;
    }

    public function getPort()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/ports/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function deletePort()
    {
        return [
            'method' => 'DELETE',
            'path'   => 'v2.0/ports/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function getFloatingIPs()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/floatingips',
            'params' => [
                'limit'   => $this->limitParam,
                //'marker'  => $this->markerParam,
            ],
        ];
    }

    public function getFloatingIP()
    {
        return [
            'method' => 'GET',
            'path'   => 'v2.0/floatingip/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

	public function putFloatingIP()
	{
		return [
			'method' => 'PUT',
			'path'   => 'v2.0/floatingips/{id}',
            'jsonKey' => 'floatingip',
			'params' => [
				'id' => $this->idParam,
                'port_id' => [
					'type' => 'string',
					'required' => true,
				],
			],
		];
	}

    private function isRequired(array $param)
    {
        return array_merge($param, ['required' => true]);
    }

    private function notRequired(array $param)
    {
        return array_merge($param, ['required' => false]);
    }
}
