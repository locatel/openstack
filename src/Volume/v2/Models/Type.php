<?php

namespace OpenStack\Volume\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Volume v2 Type.
 *
 * @property \OpenStack\Volume\v2\Api $api
 */
class Type extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $links;

    protected $resourceKey = 'volume_type';
    protected $resourcesKey = 'volume_types';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getType(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }
}
