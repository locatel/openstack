<?php

namespace OpenStack\Network\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Network v2 Port.
 *
 * @property \OpenStack\Network\v2\Api $api
 */
class Port extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $status;
    public $adminStateUp;
    public $macAddress;
    public $networkId;
    public $deviceOwner;
    public $fixedIps;

    protected $resourceKey = 'port';
    protected $resourcesKey = 'ports';

	protected $aliases = [
		'admin_state_up' => 'adminStateUp',
		'mac_address' => 'macAddress',
		'network_id' => 'networkId',
		'device_owner' => 'deviceOwner',
		'fixed_ips' => 'fixedIps',
	];

    /**
     * {@inheritDoc}
     *
     * @param array $userOptions {@see \OpenStack\Network\v2\Api::postPort}
     */
    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postPort(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getPort(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deletePort(), $this->getAttrs(['id']));
    }

}
