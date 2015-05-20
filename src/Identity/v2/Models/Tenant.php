<?php

namespace OpenStack\Identity\v2\Models;

use OpenStack\Common\Resource\AbstractResource;

/**
 * Represents an Identity v2 Tenant.
 *
 * @package OpenStack\Identity\v2\Models
 */
class Tenant extends AbstractResource
{
    public $domain;
    public $id;
    public $links;
    public $name;
    public $description;

	protected $resourceKey = 'tenant';
	protected $resourcesKey = 'tenants';

    public function populateFromArray(array $data)
    {
        parent::populateFromArray($data);
    }

    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postTenant(), $userOptions);
        return $this->populateFromResponse($response);
    }
	
}
