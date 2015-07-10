<?php

namespace OpenStack\Network\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Network v2 Network.
 *
 * @property \OpenStack\Network\v2\Api $api
 */
class Network extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $status;
    public $subnets;
    public $shared;
    public $links;
	public $external;

    protected $resourceKey = 'network';
    protected $resourcesKey = 'networks';

	protected $aliases = [
		'router:external' => 'external',
	];

    /**
     * {@inheritDoc}
     *
     * @param array $userOptions {@see \OpenStack\Network\v2\Api::postNetwork}
     */
    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postNetwork(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getNetwork(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteNetwork(), $this->getAttrs(['id']));
    }

}
