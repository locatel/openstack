<?php

namespace OpenStack\DNS\v1;

use OpenStack\Common\Service\AbstractService;

/**
 * DNS v1 service for OpenStack.
 *
 * @property \OpenStack\DNS\v1\Api $api
 */
class Service extends AbstractService
{
    /**
     * List domains.
     *
     * @param array    $options {@see \OpenStack\DNS\v1\Api::getDomains}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listDomains(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getDomains(), $options);
        return $this->model('Domain')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a domain object without calling the remote API.
     *
     * @param array $options An array of attributes that will be set on the {@see Domain} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\DNS\v1\Models\Domain
     */
    public function getDomain(array $options = [])
    {
        $domain = $this->model('Domain');
        $domain->populateFromArray($options);
        return $domain;
    }

    public function createDomain(array $options)
    {
        return $this->model('Domain')->create($options);
    }

    public function getDomainRecords(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getDomainRecords(), $options);
        return $this->model('Record')->enumerate($operation, $mapFn);
    }

    public function getRecord(array $options = [])
    {
        $record = $this->model('Record');
        $record->populateFromArray($options);
        return $record;
    }

    public function createRecord(array $options)
    {
        return $this->model('Record')->create($options);
    }
}
