<?php

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Compute v2 Secgroup.
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class Secgroup extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $description;
    public $rules;

    protected $resourceKey = 'security_group';
    protected $resourcesKey = 'security_groups';


	/**
	 * {@inheritDoc}
	 */
	/*
	public function populateFromArray(array $array)
	{
		if (isset($array['security_groups'])) {
			foreach ($array['security_groups'] as $key => $val) {
				$property = isset($this->aliases[$key]) ? $this->aliases[$key] : $key;
				if (property_exists($this, $property)) {
					$this->$property = $val;
				}
			}
		}
		else {
			parent::populateFromArray($array);
		}
	}
	*/

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getSecgroup(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     *
     */
    public function create(array $data)
    {
        $response = $this->execute($this->api->postSecgroup(), $data);
        return $this->populateFromResponse($response);
    }


    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteSecgroup(), $this->getAttrs(['id']));
    }

}
