<?php

namespace OpenStack\Network\v2;

use OpenStack\Common\Service\AbstractService;

/**
 * Network v2 service for OpenStack.
 *
 * @property \OpenStack\Network\v2\Api $api
 */
class Service extends AbstractService
{
    /**
     * List networks.
     *
     * @param array    $options {@see \OpenStack\Network\v2\Api::getNetworks}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listNetworks(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getNetworks(), $options);
        return $this->model('Network')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a network object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Network::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Network} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Network\v2\Models\Network
     */
    public function getNetwork(array $options = [])
    {
        $network = $this->model('Network');
        $network->populateFromArray($options);
        return $network;
    }

    /**
     * List subnets.
     *
     * @param array    $options {@see \OpenStack\Network\v2\Api::getSubnets}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listSubnets(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getSubnets(), $options);
        return $this->model('Subnet')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a subnet object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Subnet::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Subnet} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Network\v2\Models\Subnet
     */
    public function getSubnet(array $options = [])
    {
        $subnet = $this->model('Subnet');
        $subnet->populateFromArray($options);
        return $subnet;
    }
}
