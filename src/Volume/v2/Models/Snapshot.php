<?php

namespace OpenStack\Volume\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Volume v2 Volume.
 *
 * @property \OpenStack\Volume\v2\Api $api
 */
class Snapshot extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $status;
    public $size;
    public $description;
    public $links;

    protected $resourceKey = 'snapshot';
    protected $resourcesKey = 'snapshots';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getSnapshot(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postSnapshot(), $userOptions);
        return $this->populateFromResponse($response);
    }
}
