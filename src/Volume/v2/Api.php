<?php

namespace OpenStack\Volume\v2;

use OpenStack\Common\Api\ApiInterface;

/**
 * A representation of the Volume (Nova) v2 REST API.
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

    public function getVolumes()
    {
        return [
            'method' => 'GET',
            'path'   => 'volumes',
            'params' => [
                'limit'   => $this->limitParam,
                'marker'  => $this->markerParam,
            ],
        ];
    }

    public function getVolumesDetail()
    {
        $op = $this->getAll();
        $op['path'] += '/detail';
        return $op;
    }

    public function getVolume()
    {
        return [
            'method' => 'GET',
            'path'   => 'volumes/{id}',
            'params' => ['id' => $this->idParam]
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
