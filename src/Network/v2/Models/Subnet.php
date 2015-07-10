<?php

namespace OpenStack\Network\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Network v2 Subnet.
 *
 * @property \OpenStack\Network\v2\Api $api
 */
class Subnet extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $cidr;
    public $links;
	public $ipVersion;

    protected $resourceKey = 'subnet';
    protected $resourcesKey = 'subnets';

	protected $aliases = [
		'ip_version' => 'ipVersion',
	];

    /**
     * {@inheritDoc}
     *
     * @param array $userOptions {@see \OpenStack\Network\v2\Api::postSubnet}
     */
    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postSubnet(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getSubnet(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }
}
