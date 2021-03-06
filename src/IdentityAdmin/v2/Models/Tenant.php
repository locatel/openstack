<?php

namespace OpenStack\IdentityAdmin\v2\Models;

use OpenStack\Common\Resource\AbstractResource;

/**
 * Represents an IdentityAdmin v2 Tenant.
 *
 * @package OpenStack\IdentityAdmin\v2\Models
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

    public function retrieve()
    {
        $response = $this->execute($this->api->getTenant(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    public function delete()
    {
        $this->execute($this->api->deleteTenant(), $this->getAttrs(['id']));
    }

	public function getUsers()
	{
		$response = $this->execute($this->api->getTenantUsers(), ['id' => $this->id]);
		return $response->json()['users'];
	}
	
}
