<?php

namespace OpenStack\Network\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Network v2 Router.
 *
 * @property \OpenStack\Network\v2\Api $api
 */
class Router extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $status;
    public $externalGatewayInfo;
    public $adminStateUp;

    protected $resourceKey = 'router';
    protected $resourcesKey = 'routers';

	protected $aliases = [
		'external_gateway_info' => 'externalGatewayInfo',
		'admin_state_up' => 'adminStateUp',
	];

    /**
     * {@inheritDoc}
     *
     * @param array $userOptions {@see \OpenStack\Network\v2\Api::postRouter}
     */
    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postRouter(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getRouter(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteRouter(), $this->getAttrs(['id']));
    }

	public function addInterface(array $options)
	{
		$response = $this->execute($this->api->putAddRouterInterface(), [ 'id' => $this->id, 'subnet_id' => $options['subnet_id'] ]);
		return $response->json();
	
	}

}
