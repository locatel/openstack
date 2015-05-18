<?php

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Compute v2 Keypair.
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class Keypair extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $fingerprint;
    public $public_key;

    protected $resourceKey = 'keypair';
    protected $resourcesKey = 'keypairs';

	/**
	 * {@inheritDoc}
	 */
	public function populateFromArray(array $array)
	{
		foreach ($array['keypair'] as $key => $val) {
			$property = isset($this->aliases[$key]) ? $this->aliases[$key] : $key;
			if (property_exists($this, $property)) {
				$this->$property = $val;
			}
		}
	}

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        //$response = $this->execute($this->api->getKeypair(), ['id' => (string) $this->id]);
        $response = $this->execute($this->api->getKeypair(), ['name' => (string) $this->name]);
        $this->populateFromResponse($response);
    }
}
