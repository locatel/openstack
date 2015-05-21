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
    public $enabled;

	protected $resourceKey = 'user';
	protected $resourcesKey = 'users';

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
	
}
