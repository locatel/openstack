<?php

namespace OpenStack\Network\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Network v2 FloatingIP.
 *
 * @property \OpenStack\Network\v2\Api $api
 */
class FloatingIP extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $status;
    public $routerId;
    public $floatingNetworkId;
    public $fixedIpAddress;
    public $floatingIpAddress;
    public $portId;

    protected $resourceKey = 'floatingip';
    protected $resourcesKey = 'floatingips';

	protected $aliases = [
		'router_id' => 'routerId',
		'floating_network_id' => 'floatingNetworkId',
		'fixed_ip_address' => 'fixedIpAddress',
		'floating_ip_address' => 'floatingIpAddress',
		'port_id' => 'portId',
	];

    /**
     * {@inheritDoc}
     *
     * @param array $userOptions {@see \OpenStack\Network\v2\Api::postFloatingIP}
     */
    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postFloatingIP(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getFloatingIP(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function update()
    {
        //$response = $this->execute($this->api->putFloatingIP(), $this->getAttrs(['id', 'port_id']));
        $response = $this->execute($this->api->putFloatingIP(), [
			'id' => (string) $this->id,
			'port_id' => $this->portId,
		]);

        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteFloatingIP(), $this->getAttrs(['id']));
    }

}
