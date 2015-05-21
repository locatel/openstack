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

    protected $resourceKey = 'network';
    protected $resourcesKey = 'networks';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getNetwork(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }
}
