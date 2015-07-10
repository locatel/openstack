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
     * Create a new network resource. 
     *
     * @param array $options {@see \OpenStack\Network\v2\Api::postNetwork}
     *
     * @return \OpenStack\Network\v2\Models\Network
     */
    public function createNetwork(array $options)
    {
        return $this->model('Network')->create($options);
    }

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

    /**
     * Create a new subnet resource. 
     *
     * @param array $options {@see \OpenStack\Network\v2\Api::postSubnet}
     *
     * @return \OpenStack\Network\v2\Models\Subnet
     */
    public function createSubnet(array $options)
    {
        return $this->model('Subnet')->create($options);
    }

    /**
     * Create a new router resource. 
     *
     * @param array $options {@see \OpenStack\Network\v2\Api::postRouter}
     *
     * @return \OpenStack\Network\v2\Models\Router
     */
    public function createRouter(array $options)
    {
        return $this->model('Router')->create($options);
    }

    /**
     * List routers.
     *
     * @param array    $options {@see \OpenStack\Network\v2\Api::getRouters}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listRouters(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getRouters(), $options);
        return $this->model('Router')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a router object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Router::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Router} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Network\v2\Models\Router
     */
    public function getRouter(array $options = [])
    {
        $router = $this->model('Router');
        $router->populateFromArray($options);
        return $router;
    }

	public function addInterface(array $options)
	{
		return $this->model('Router')->addInterface($options);
	}

    /**
     * Create a new port resource. 
     *
     * @param array $options {@see \OpenStack\Network\v2\Api::postPort}
     *
     * @return \OpenStack\Network\v2\Models\Port
     */
    public function createPort(array $options)
    {
        return $this->model('Port')->create($options);
    }

    /**
     * List ports.
     *
     * @param array    $options {@see \OpenStack\Network\v2\Api::getPorts}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listPorts(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getPorts(), $options);
        return $this->model('Port')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a port object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see Port::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see Port} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Network\v2\Models\Port
     */
    public function getPort(array $options = [])
    {
        $port = $this->model('Port');
        $port->populateFromArray($options);
        return $port;
    }

    /**
     * List floatingips.
     *
     * @param array    $options {@see \OpenStack\Network\v2\Api::getFloatingIPs}
     * @param callable $mapFn   A callable function that will be invoked on every iteration of the list.
     *
     * @return \Generator
     */
    public function listFloatingIPs(array $options = [], callable $mapFn = null)
    {
        $operation = $this->getOperation($this->api->getFloatingIPs(), $options);
        return $this->model('FloatingIP')->enumerate($operation, $mapFn);
    }

    /**
     * Retrieve a floatingip object without calling the remote API. Any values provided in the array will populate the
     * empty object, allowing you greater control without the expense of network transactions. To call the remote API
     * and have the response populate the object, call {@see FloatingIP::retrieve}.
     *
     * @param array $options An array of attributes that will be set on the {@see FloatingIP} object. The array keys need to
     *                       correspond to the class public properties.
     *
     * @return \OpenStack\Network\v2\Models\FloatingIP
     */
    public function getFloatingIP(array $options = [])
    {
        $floatingip = $this->model('FloatingIP');
        $floatingip->populateFromArray($options);
        return $floatingip;
    }
}
