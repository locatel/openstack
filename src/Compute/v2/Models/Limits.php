<?php

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\IsRetrievable;
use OpenStack\Common\Resource\IsRetrievableInterface;
use OpenStack\Common\Resource\AbstractResource;

/**
 * Represents a Compute v2 Limits.
 *
 * @property \OpenStack\Compute\v2\Api $api
 */
class Limits extends AbstractResource implements IsRetrievable
{
    public $maxSecurityGroups;
	public $totalSecurityGroupsUsed;

    public $maxTotalInstances;
    public $totalInstancesUsed;

    public $maxTotalRAMSize;
    public $totalRAMUsed;

    public $maxTotalFloatingIps;
	public $totalFloatingIpsUsed;

	public $maxTotalCores;
	public $totalCoresUsed;

    protected $resourceKey = 'limits';
    protected $resourcesKey = 'limits';

    public function populateFromArray(array $array)
    {
        if (isset($array['absolute'])) {
            foreach ($array['absolute'] as $key => $val) {
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

	public function retrieve()
	{
		//$response = $this->execute($this->api->getLimits(), $this->getAttrs(['id']));
		$response = $this->execute($this->api->getLimits());
		return $this->populateFromResponse($response);
	}

}
