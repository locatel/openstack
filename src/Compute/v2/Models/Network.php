<?php

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Compute v2 Network.
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class Network extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $cidr;
    public $label;
    public $status;

    protected $resourceKey = 'network';
    protected $resourcesKey = 'networks';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getNetwork(), ['id' => (string) $this->id]);
        //$response = $this->execute($this->api->getNetwork(), ['name' => (string) $this->name]);
        $this->populateFromResponse($response);
    }
}
