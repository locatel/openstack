<?php

namespace OpenStack\Compute\v2\Models;

use OpenStack\Common\Resource\HasWaiterTrait;
use OpenStack\Common\Resource\IsCreatable;
use OpenStack\Common\Resource\IsDeletable;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;
use OpenStack\Common\Resource\IsRetrievableInterface;
use OpenStack\Common\Resource\IsUpdateable;
use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Compute\v2\Enum;

/**
 * @property \OpenStack\Compute\v2\Api $api
 */
class Server extends AbstractResource implements
    IsCreatable,
    IsUpdateable,
    IsDeletable,
    IsRetrievable,
    IsListable
{
    use HasWaiterTrait;

    public $id;
    public $ipv4;
    public $ipv6;
    public $addresses;
    public $created;
    public $updated;
    public $flavor;
    public $hostId;
    public $host;
    public $hypervisor;
    public $image;
    public $links;
    public $metadata;
    public $name;
    public $progress;
    public $status;
    public $tenantId;
    public $userId;
    public $adminPass;
    public $taskState;
    public $keyName;
    public $volumes;
	public $securityGroups;

    protected $resourceKey = 'server';
    protected $resourcesKey = 'servers';
    protected $markerKey = 'id';

    protected $aliases = [
        'block_device_mapping_v2' => 'blockDeviceMapping',
        'accessIPv4' => 'ipv4',
        'accessIPv6' => 'ipv6',
        'tenant_id'  => 'tenantId',
        'user_id'    => 'userId',
        'user_data'    => 'userData',
        'security_groups' => 'securityGroups',
        'OS-EXT-STS:task_state' => 'taskState',
		'OS-EXT-SRV-ATTR:host' => 'host',
		'OS-EXT-SRV-ATTR:hypervisor_hostname' => 'hypervisor',
        'key_name'  => 'keyName',
		'os-extended-volumes:volumes_attached' => 'volumes',
    ];

    /**
     * {@inheritDoc}
     */
    public function populateFromArray(array $data)
    {
        parent::populateFromArray($data);

        $this->created = new \DateTimeImmutable($this->created);
        $this->updated = new \DateTimeImmutable($this->updated);

        if (isset($data['flavor'])) {
            $this->flavor = $this->model('Flavor', $data['flavor']);
        }

        if (isset($data['image'])) {
            $this->image = $this->model('Image', $data['image']);
        }
    }

    /**
     * {@inheritDoc}
     *
     * @param array $userOptions {@see \OpenStack\Compute\v2\Api::postServer}
     */
    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postServer(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function update()
    {
        $response = $this->execute($this->api->putServer(), $this->getAttrs(['id', 'name', 'ipv4', 'ipv6']));

        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        $this->execute($this->api->deleteServer(), $this->getAttrs(['id']));
    }

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getServer(), $this->getAttrs(['id']));

        return $this->populateFromResponse($response);
    }

    /**
     * Changes the root password for a server.
     *
     * @param string $newPassword The new root password
     */
    public function changePassword($newPassword)
    {
        $this->execute($this->api->changeServerPassword(), [
            'id'       => $this->id,
            'password' => $newPassword
        ]);
    }

    /**
     * Reboots the server.
     *
     * @param string $type The type of reboot that will be performed. Either SOFT or HARD is supported.
     */
    public function reboot($type = Enum::REBOOT_SOFT)
    {
        if (!in_array($type, ['SOFT', 'HARD'])) {
            throw new \RuntimeException('Reboot type must either be SOFT or HARD');
        }

        $this->execute($this->api->rebootServer(), [
            'id'   => $this->id,
            'type' => $type,
        ]);
    }

    /**
     * Start the server.
     */
    public function start()
    {
        $this->execute($this->api->startServer(), [
            'id'   => $this->id,
        ]);
    }

    /**
     * Stop the server.
     */
    public function stop()
    {
        $this->execute($this->api->stopServer(), [
            'id'   => $this->id,
        ]);
    }

    /**
     * Rebuilds the server.
     *
     * @param array $options {@see \OpenStack\Compute\v2\Api::rebuildServer}
     */
    public function rebuild(array $options)
    {
        $options['id'] = $this->id;
        $response = $this->execute($this->api->rebuildServer(), $options);
        
        $this->populateFromResponse($response);
    }

    /**
     * Resizes the server to a new flavor. Once this operation is complete and server has transitioned
     * to an active state, you will either need to call {@see confirmResize()} or {@see revertResize()}.
     *
     * @param string $flavorId The UUID of the new flavor your server will be based on.
     */
    public function resize($flavorId)
    {
        $response = $this->execute($this->api->resizeServer(), [
            'id' => $this->id,
            'flavorId' => $flavorId,
        ]);

        $this->populateFromResponse($response);
    }

    /**
     * Confirms a previous resize operation.
     */
    public function confirmResize()
    {
        $this->execute($this->api->confirmServerResize(), ['confirmResize' => null, 'id' => $this->id]);
    }

    /**
     * Reverts a previous resize operation.
     */
    public function revertResize()
    {
        $this->execute($this->api->revertServerResize(), ['revertResize' => null, 'id' => $this->id]);
    }

    /**
     * Creates an image for the current server.
     *
     * @param array $options {@see \OpenStack\Compute\v2\Api::createServerImage}
     */
    public function createImage(array $options)
    {
        $options['id'] = $this->id;
        $this->execute($this->api->createServerImage(), $options);
    }

    /**
     * Iterates over all the IP addresses for this server.
     *
     * @param array $options {@see \OpenStack\Compute\v2\Api::getAddressesByNetwork}
     *
     * @return array An array containing to two keys: "public" and "private"
     */
    public function listAddresses(array $options = [])
    {
        $options['id'] = $this->id;

        $data = (isset($options['networkLabel'])) ? $this->api->getAddressesByNetwork() : $this->api->getAddresses();
        $response = $this->execute($data, $options);
        return $response->json()['addresses'];
    }

    /**
     * Retrieves metadata from the API.
     *
     * @return array
     */
    public function getMetadata()
    {
        $response = $this->execute($this->api->getServerMetadata(), ['id' => $this->id]);
        return $response->json()['metadata'];
    }

    /**
     * Resets all the metadata for this server with the values provided. All existing metadata keys
     * will either be replaced or removed.
     *
     * @param array $metadata {@see \OpenStack\Compute\v2\Api::putServerMetadata}
     *
     * @return mixed
     */
    public function resetMetadata(array $metadata)
    {
        $response = $this->execute($this->api->putServerMetadata(), ['id' => $this->id, 'metadata' => $metadata]);
        return $response->json()['metadata'];
    }

    /**
     * Merges the existing metadata for the server with the values provided. Any existing keys
     * referenced in the user options will be replaced with the user's new values. All other
     * existing keys will remain unaffected.
     *
     * @param array $metadata {@see \OpenStack\Compute\v2\Api::postServerMetadata}
     *
     * @return mixed
     */
    public function mergeMetadata(array $metadata)
    {
        $response = $this->execute($this->api->postServerMetadata(), ['id' => $this->id, 'metadata' => $metadata]);
        return $response->json()['metadata'];
    }

    /**
     * Retrieve the value for a specific metadata key.
     *
     * @param string $key {@see \OpenStack\Compute\v2\Api::getServerMetadataKey}
     *
     * @return mixed
     */
    public function getMetadataItem($key)
    {
        $response = $this->execute($this->api->getServerMetadataKey(), ['id' => $this->id, 'key' => $key]);
        return $response->json()['metadata'][$key];
    }

    /**
     * Remove a specific metadata key.
     *
     * @param string $key {@see \OpenStack\Compute\v2\Api::deleteServerMetadataKey}
     */
    public function deleteMetadataItem($key)
    {
        $this->execute($this->api->deleteServerMetadataKey(), ['id' => $this->id, 'key' => $key]);
    }

    /**
     * Get server's VNC console
     *
     * @return mixed
     */
    public function getConsole()
    {
        $response = $this->execute($this->api->getConsole(), ['id' => $this->id, 'type' => 'novnc']);
        return $response->json()['console']['url'];
    }

    /**
     * Get server's console output
     *
     * @return mixed
     */
    public function getConsoleOutput($length)
    {
        $response = $this->execute($this->api->getConsoleOutput(), ['id' => $this->id, 'length' => $length]);
        return $response->json()['output'];
    }
}
