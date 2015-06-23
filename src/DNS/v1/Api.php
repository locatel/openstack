<?php

namespace OpenStack\DNS\v1;

use OpenStack\Common\Api\ApiInterface;

/**
 * A representation of the DNS (Designate) v1 REST API.
 *
 * @internal
 * @package OpenStack\Volume\v2
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

    public function getDomains()
    {
        return [
            'method' => 'GET',
            'path'   => 'domains',
            'params' => [
                'limit'   => $this->limitParam,
            ],
        ];
    }

    public function getDomain()
    {
        return [
            'method' => 'GET',
            'path'   => 'domains/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function deleteDomain()
    {
        return [
            'method' => 'DELETE',
            'path'   => 'domains/{id}',
            'params' => ['id' => $this->idParam]
        ];
    }

    public function postDomain()
    {
        return [
            'method' => 'POST',
            'path'   => 'domains',
            //'jsonKey' => 'domain',
              'params' => [
                  'name' => [
                      'type' => 'string',
                      'required' => true,
                  ],
                  'ttl' => [
                      'type' => 'integer',
                      'required' => true,
                  ],
                 'email' => [
                      'type' => 'string',
                      'required' => true,
                  ],
            ]
        ];
    }

    public function getDomainRecords()
    {
        return [
            'method' => 'GET',
            'path'   => 'domains/{id}/records',
			'params' => ['id' => $this->idParam]
        ];
    }

    public function postRecord()
    {
        return [
            'method' => 'POST',
            'path'   => 'domains/{domain_id}/records',
            //'jsonKey' => 'domain',
              'params' => [
				  'domain_id' => $this->idParam,
                  'name' => [
                      'type' => 'string',
                      'required' => true,
                  ],
                  'type' => [
                      'type' => 'string',
                      'required' => true,
                  ],
                 'data' => [
                      'type' => 'string',
                      'required' => true,
                  ],
            ]
        ];
    }

    public function getRecord()
    {
        return [
            'method' => 'GET',
            'path'   => 'domains/{domain_id}/records/{id}',
            'params' => [
				'domain_id' => $this->idParam,
				'id' => $this->idParam,
			]
        ];
    }

    public function deleteRecord()
    {
        return [
            'method' => 'DELETE',
            'path'   => 'domains/{domain_id}/records/{id}',
            'params' => [
				'domain_id' => $this->idParam,
				'id' => $this->idParam,
			]
        ];
    }
}
