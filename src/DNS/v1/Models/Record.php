<?php

namespace OpenStack\DNS\v1\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a DNS v1 Record.
 *
 * @property \OpenStack\DNS\v1\Api $api
 */
class Record extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $type;
    public $ttl;
    public $data;
    public $domain_id;

    protected $resourceKey = 'record';
    protected $resourcesKey = 'records';

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getRecord(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    public function getDomainRecords()
    {
        $response = $this->execute($this->api->getDomainRecords(), ['id' => (string) $this->id]);
        return $this->populateFromResponse($response);
    }

    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postRecord(), $userOptions);
        return $this->populateFromResponse($response);
    }

	/**
	 * {@inheritDoc}
	 */
	 public function delete()
	 {
	 	$this->execute($this->api->deleteRecord(), [
			'id' => (string) $this->id,
			'domain_id' => (string) $this->domain_id,
		]);
	 }

}
