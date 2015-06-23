<?php

namespace OpenStack\DNS\v1\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a DNS v1 Domain.
 *
 * @property \OpenStack\DNS\v1\Api $api
 */
class Domain extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $ttl;
    public $email;

    protected $resourceKey = 'domain';
    protected $resourcesKey = 'domains';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getDomain(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    public function getRecords()
    {
        $response = $this->execute($this->api->getRecords(), ['id' => (string) $this->id]);
        return $this->populateFromResponse($response);
    }

    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postDomain(), $userOptions);
        return $this->populateFromResponse($response);
    }

	/**
	 * {@inheritDoc}
	 */
	 public function delete()
	 {
	 	$this->execute($this->api->deleteDomain(), $this->getAttrs(['id']));
	 }

}
