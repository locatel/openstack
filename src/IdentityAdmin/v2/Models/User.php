<?php

namespace OpenStack\IdentityAdmin\v2\Models;

use OpenStack\Common\Resource\AbstractResource;

/**
 * Represents an IdentityAdmin v2 User.
 *
 * @package OpenStack\IdentityAdmin\v2\Models
 */
class User extends AbstractResource
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $enabled;

	protected $resourceKey = 'user';
	protected $resourcesKey = 'users';

	protected $aliases = [
		'OS-KSADM:password' => 'password',
	];

    public function populateFromArray(array $data)
    {
        parent::populateFromArray($data);
    }


    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getUser(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postUser(), $userOptions);
        return $this->populateFromResponse($response);
    }

	public function delete()
	{
		$this->execute($this->api->deleteUser(), $this->getAttrs(['id']));
	}

    public function associate(array $options)
    {
		$response = $this->execute($this->api->associateUser(), ['user_id' => $this->id, 'role_id' => $options['role_id'], 'tenant_id' => $options['tenant_id']]);
		//return $response->json()['metadata'][$key];
		return $response->json();
    }
	
}
